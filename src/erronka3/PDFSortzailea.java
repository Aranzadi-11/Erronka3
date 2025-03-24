package erronka3;

import org.apache.pdfbox.pdmodel.font.PDType1Font;
import org.apache.pdfbox.pdmodel.PDDocument;
import org.apache.pdfbox.pdmodel.PDPage;
import org.apache.pdfbox.pdmodel.PDPageContentStream;
import javax.swing.*;
import java.awt.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.io.File;

public class PDFSortzailea {

    public static void mostrarFormulario() {
        JFrame frame = new JFrame("PDF Sortu - Erreserbak");
        frame.setDefaultCloseOperation(JFrame.DISPOSE_ON_CLOSE);
        frame.setLayout(new BorderLayout());

        JPanel panel = new JPanel(new GridBagLayout());
        panel.setBackground(Color.WHITE);
        GridBagConstraints gbc = new GridBagConstraints();
        gbc.insets = new Insets(5,5,5,5);
        gbc.fill = GridBagConstraints.HORIZONTAL;

        // Kombobox logelarako: "izena" lortu logelak taulatik
        gbc.gridx = 0; gbc.gridy = 0;
        panel.add(new JLabel("Logela (Izena):"), gbc);
        gbc.gridx = 1;
        JComboBox<String> logelaCombo = new JComboBox<>(DBAukerak.getLogelaIzenaArray());
        panel.add(logelaCombo, gbc);

        // Kombobox bezeroarako: "erabiltzaileIzena", filtratuz logelaren arabera
        gbc.gridx = 0; gbc.gridy = 1;
        panel.add(new JLabel("Bezeroa (Erabiltzaile Izena):"), gbc);
        gbc.gridx = 1;
        JComboBox<String> bezeroCombo = new JComboBox<>(new String[]{});  // Inicializamos el combo vacío
        panel.add(bezeroCombo, gbc);

        // Kombobox data: erreserba datak
        gbc.gridx = 0; gbc.gridy = 2;
        panel.add(new JLabel("Data:"), gbc);
        gbc.gridx = 1;
        JComboBox<String> dataCombo = new JComboBox<>(new String[]{});  // Inicializamos el combo vacío
        panel.add(dataCombo, gbc);

        // Logela aukeratuenean, bezeroak eguneratu
        logelaCombo.addActionListener(new ActionListener(){
            public void actionPerformed(ActionEvent e) {
                String logelaIzena = (String) logelaCombo.getSelectedItem();
                String[] bezeroak = DBAukerak.getBezeroErreserbatuArray(logelaIzena);
                bezeroCombo.setModel(new DefaultComboBoxModel<>(bezeroak));
            }
        });

        // Bezero aukeratuenean, datak eguneratu
        bezeroCombo.addActionListener(new ActionListener(){
            public void actionPerformed(ActionEvent e) {
                String logelaIzena = (String) logelaCombo.getSelectedItem();
                String bezeroIzena = (String) bezeroCombo.getSelectedItem();
                String[] datak = DBAukerak.getErreserbaDataArray(logelaIzena, bezeroIzena);
                dataCombo.setModel(new DefaultComboBoxModel<>(datak));
            }
        });

        JPanel buttonPanel = new JPanel();
        buttonPanel.setBackground(Color.WHITE);
        JButton sortuButton = new JButton("Sortu PDF");
        JButton ezeztatuButton = new JButton("Ezeztatu");
        buttonPanel.add(sortuButton);
        buttonPanel.add(ezeztatuButton);

        sortuButton.addActionListener(new ActionListener(){
            public void actionPerformed(ActionEvent e) {
                // Informazioa hartu
                String logela = (String) logelaCombo.getSelectedItem();
                String bezero = (String) bezeroCombo.getSelectedItem();
                String data = (String) dataCombo.getSelectedItem();

                // Llamar a la función de DBAukerak para obtener las fechas y precios
                String[] erreserbaInfo = DBAukerak.getErreserbaInformazioa(logela, bezero, data);
                String sarreraData = erreserbaInfo[0];
                String irteeraData = erreserbaInfo[1];
                String sarreraOrdua = erreserbaInfo[2];
                String irteeraOrdua = erreserbaInfo[3];
                String prezioa = erreserbaInfo[4];

                JFileChooser fileChooser = new JFileChooser();
                fileChooser.setDialogTitle("Aukeratu non gorde PDF-a");

                // Agregar filtro para que solo se puedan seleccionar archivos .pdf
                fileChooser.addChoosableFileFilter(new javax.swing.filechooser.FileNameExtensionFilter("PDF files", "pdf"));

                // Establecer el tipo de archivo predeterminado
                fileChooser.setAcceptAllFileFilterUsed(false);  // Esto desactiva la opción de "todos los archivos"

                int userSelection = fileChooser.showSaveDialog(frame);
                if (userSelection == JFileChooser.APPROVE_OPTION) {
                    File fileToSave = fileChooser.getSelectedFile();
                    
                    // Asegurarse de que la extensión .pdf esté presente
                    if (!fileToSave.getName().endsWith(".pdf")) {
                        fileToSave = new File(fileToSave.getAbsolutePath() + ".pdf");
                    }
                    
                    try (PDDocument document = new PDDocument()) {
                        PDPage page = new PDPage();
                        document.addPage(page);

                        PDPageContentStream contentStream = new PDPageContentStream(document, page);

                        // Establecer la fuente
                        contentStream.setFont(PDType1Font.HELVETICA_BOLD, 18);  // Negrita para el título
                        contentStream.beginText();
                        contentStream.newLineAtOffset(50, 750);
                        contentStream.showText("FAKTURA");
                        contentStream.endText();

                        // Información de la reserva
                        contentStream.setFont(PDType1Font.HELVETICA, 12);  // Fuente normal para el contenido
                        contentStream.beginText();
                        contentStream.newLineAtOffset(50, 700);
                        contentStream.showText("Logela: " + logela);
                        contentStream.endText();

                        contentStream.beginText();
                        contentStream.newLineAtOffset(50, 680);
                        contentStream.showText("Bezeroa: " + bezero);
                        contentStream.endText();

                        contentStream.beginText();
                        contentStream.newLineAtOffset(50, 660);
                        contentStream.showText("Erreserba eguna: " + data);
                        contentStream.endText();
                        
                        contentStream.beginText();
                        contentStream.newLineAtOffset(50, 640);
                        contentStream.showText("Sarrera eguna: " + sarreraData);
                        contentStream.endText();
                        
                        contentStream.beginText();
                        contentStream.newLineAtOffset(50, 620);
                        contentStream.showText("Irteera eguna: " + irteeraData);
                        contentStream.endText();
                        
                        contentStream.beginText();
                        contentStream.newLineAtOffset(50, 600);
                        contentStream.showText("Sarrera ordua: " + sarreraOrdua);
                        contentStream.endText();
                        
                        contentStream.beginText();
                        contentStream.newLineAtOffset(50, 580);
                        contentStream.showText("Irteera ordua: " + irteeraOrdua);
                        contentStream.endText();
                        
                        contentStream.beginText();
                        contentStream.newLineAtOffset(50, 560);
                        contentStream.showText("Prezioa: " + prezioa);
                        contentStream.endText();

                        // Dibujar línea para separar secciones
                        contentStream.setLineWidth(1f);
                        contentStream.moveTo(50, 520);
                        contentStream.lineTo(550, 520);
                        contentStream.stroke();

                        // Guardar el PDF
                        contentStream.close();
                        document.save(fileToSave);
                        JOptionPane.showMessageDialog(null, "PDF-a ongi sortu eta gorde da: " + fileToSave.getAbsolutePath(), "Info", JOptionPane.INFORMATION_MESSAGE);
                    } catch(Exception ex) {
                        JOptionPane.showMessageDialog(null, "Errorea PDF sortzean: " + ex.getMessage(), "Errorea", JOptionPane.ERROR_MESSAGE);
                    }
                }
            }
        });

        // Acción para el botón de cancelación
        ezeztatuButton.addActionListener(new ActionListener(){
            public void actionPerformed(ActionEvent e) {
                frame.dispose();  // Cerrar el formulario
            }
        });

        frame.add(panel, BorderLayout.CENTER);
        frame.add(buttonPanel, BorderLayout.SOUTH);
        frame.pack();
        frame.setLocationRelativeTo(null);
        frame.setVisible(true);
    }
}
