package erronka3;

import org.apache.pdfbox.pdmodel.PDDocument;
import org.apache.pdfbox.pdmodel.PDPage;
import org.apache.pdfbox.pdmodel.PDPageContentStream;
import org.apache.pdfbox.pdmodel.font.PDType1Font;
import org.apache.pdfbox.pdmodel.graphics.image.PDImageXObject;
import javax.swing.*;
import java.awt.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.io.File;

public class PDFSortzailea {

    public static void formularioaErakutsi() {
        JFrame frame = new JFrame("Faktura sortu - Erreserbak");
        frame.setDefaultCloseOperation(JFrame.DISPOSE_ON_CLOSE);
        frame.setLayout(new BorderLayout());

        JPanel panel = new JPanel(new GridBagLayout());
        panel.setBackground(Color.WHITE);
        GridBagConstraints gbc = new GridBagConstraints();
        gbc.insets = new Insets(5,5,5,5);
        gbc.fill = GridBagConstraints.HORIZONTAL;

        //Logelaren izena lortu logelak taulatik
        gbc.gridx = 0; gbc.gridy = 0;
        panel.add(new JLabel("Logela:"), gbc);
        gbc.gridx = 1;
        JComboBox<String> logelaCombo = new JComboBox<>(DBAukerak.getLogelaIzenaArray());
        panel.add(logelaCombo, gbc);

        //Bezeroaren izena lortu bezeroak taulatik
        gbc.gridx = 0; gbc.gridy = 1;
        panel.add(new JLabel("Erabiltzaile izena:"), gbc);
        gbc.gridx = 1;
        JComboBox<String> bezeroCombo = new JComboBox<>(new String[]{}); 
        panel.add(bezeroCombo, gbc);

        //Erreserba eguna
        gbc.gridx = 0; gbc.gridy = 2;
        panel.add(new JLabel("Erreserba eguna:"), gbc);
        gbc.gridx = 1;
        JComboBox<String> dataCombo = new JComboBox<>(new String[]{});  
        panel.add(dataCombo, gbc);

        //Logela aukeratzean, bezeroen kutxa eguneratu
        logelaCombo.addActionListener(new ActionListener(){
            public void actionPerformed(ActionEvent e) {
                String logelaIzena = (String) logelaCombo.getSelectedItem();
                String[] bezeroak = DBAukerak.getBezeroErreserbatuArray(logelaIzena);
                bezeroCombo.setModel(new DefaultComboBoxModel<>(bezeroak));
            }
        });

        //Bezero aukeratzean, erreserba egunak eguneratu
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
                //Informazioa hartu
                String logela = (String) logelaCombo.getSelectedItem();
                String bezero = (String) bezeroCombo.getSelectedItem();
                String data = (String) dataCombo.getSelectedItem();

                //DBAukearak klaseari deitu informazio gehigo lortzeko
                String[] erreserbaInfo = DBAukerak.getErreserbaInformazioa(logela, bezero, data);
                String sarreraData = erreserbaInfo[0];
                String irteeraData = erreserbaInfo[1];
                String sarreraOrdua = erreserbaInfo[2];
                String irteeraOrdua = erreserbaInfo[3];
                String prezioa = erreserbaInfo[4];

                JFileChooser fileChooser = new JFileChooser();
                fileChooser.setDialogTitle("Aukeratu non gorde PDF-a");

                //Filtroa ezarri .pdf bakarrik onartzeko
                fileChooser.addChoosableFileFilter(new javax.swing.filechooser.FileNameExtensionFilter("PDF files", "pdf"));

                //erabiltzaileari aukeratzen ez uzteko
                fileChooser.setAcceptAllFileFilterUsed(false);

                int userSelection = fileChooser.showSaveDialog(frame);
                if (userSelection == JFileChooser.APPROVE_OPTION) {
                    File fileToSave = fileChooser.getSelectedFile();
                    
                    //.pdf extensioa ezarri gordetzeko orduan
                    if (!fileToSave.getName().endsWith(".pdf")) {
                        fileToSave = new File(fileToSave.getAbsolutePath() + ".pdf");
                    }
                    
                    try (PDDocument document = new PDDocument()) {
                        PDPage page = new PDPage();
                        document.addPage(page);

                        PDPageContentStream contentStream = new PDPageContentStream(document, page);
                        
                        //PDF-aren buruko kolorea
                        contentStream.setNonStrokingColor(0, 102, 204); // Azul (RGB)
                        contentStream.addRect(0, 720, page.getMediaBox().getWidth(), 100);
                        contentStream.fill();

                        try {
                        	PDImageXObject image = PDImageXObject.createFromFile("image/BBC_Grand_Hotel_Logo.png", document);
                            float imageWidth = 80;
                            float imageHeight = 80;
                            float imageX = page.getMediaBox().getWidth() - imageWidth - 20;
                            float imageY = 720; 
                            contentStream.drawImage(image, imageX, imageY, imageWidth, imageHeight);
                        } catch (Exception imgEx) {
                            System.err.println("No se pudo cargar la imagen: " + imgEx.getMessage());
                        }
                        
                        //Tituloaren letra mota
                        contentStream.setFont(PDType1Font.HELVETICA_BOLD, 18);  // Negrita para el título
                        contentStream.beginText();
                        contentStream.setNonStrokingColor(Color.WHITE);
                        contentStream.newLineAtOffset(50, 750);
                        contentStream.showText("FAKTURA");
                        contentStream.endText();
                        
                        //Letra beltzez jarri
                        contentStream.setNonStrokingColor(Color.BLACK);
                        contentStream.setFont(PDType1Font.HELVETICA, 12);
                        
                        int posY = 700;
                        int lineSpacing = 20;

                        //Erreserbaren informazioa lerrokatuta
                        
                        //Logelaren lerroa
                        posY -= lineSpacing;
                        contentStream.setFont(PDType1Font.HELVETICA_BOLD, 12);
                        contentStream.beginText();
                        contentStream.newLineAtOffset(50, 700);
                        contentStream.showText("Logela:");
                        contentStream.endText();

                        contentStream.setFont(PDType1Font.HELVETICA, 12);
                        contentStream.beginText();
                        contentStream.newLineAtOffset(100, 700);
                        contentStream.showText(logela);
                        contentStream.endText();

                        //Bezeroaren lerroa
                        posY -= lineSpacing;
                        contentStream.setFont(PDType1Font.HELVETICA_BOLD, 12);
                        contentStream.beginText();
                        contentStream.newLineAtOffset(50, 680);
                        contentStream.showText("Bezeroa:");
                        contentStream.endText();

                        contentStream.setFont(PDType1Font.HELVETICA, 12);
                        contentStream.beginText();
                        contentStream.newLineAtOffset(110, 680);
                        contentStream.showText(bezero);
                        contentStream.endText();

                        //ErreserbaEgunaren lerroa
                        posY -= lineSpacing;
                        contentStream.setFont(PDType1Font.HELVETICA_BOLD, 12);
                        contentStream.beginText();
                        contentStream.newLineAtOffset(50, 660);
                        contentStream.showText("Erreserba eguna:");
                        contentStream.endText();

                        contentStream.setFont(PDType1Font.HELVETICA, 12);
                        contentStream.beginText();
                        contentStream.newLineAtOffset(160, 660);
                        contentStream.showText(data);
                        contentStream.endText();

                        //SarreraEgunaren lerroa
                        posY -= lineSpacing;
                        contentStream.setFont(PDType1Font.HELVETICA_BOLD, 12);
                        contentStream.beginText();
                        contentStream.newLineAtOffset(50, 640);
                        contentStream.showText("Sarrera eguna:");
                        contentStream.endText();

                        contentStream.setFont(PDType1Font.HELVETICA, 12);
                        contentStream.beginText();
                        contentStream.newLineAtOffset(140, 640);
                        contentStream.showText(sarreraData);
                        contentStream.endText();

                        //IrteeraEgunaren lerroa
                        posY -= lineSpacing;
                        contentStream.setFont(PDType1Font.HELVETICA_BOLD, 12);
                        contentStream.beginText();
                        contentStream.newLineAtOffset(50, 620);
                        contentStream.showText("Irteera eguna:");
                        contentStream.endText();

                        contentStream.setFont(PDType1Font.HELVETICA, 12);
                        contentStream.beginText();
                        contentStream.newLineAtOffset(135, 620);
                        contentStream.showText(irteeraData);
                        contentStream.endText();

                        //SarreraOrduaren lerroa
                        posY -= lineSpacing;
                        contentStream.setFont(PDType1Font.HELVETICA_BOLD, 12);
                        contentStream.beginText();
                        contentStream.newLineAtOffset(50, 600);
                        contentStream.showText("Sarrera ordua:");
                        contentStream.endText();

                        contentStream.setFont(PDType1Font.HELVETICA, 12);
                        contentStream.beginText();
                        contentStream.newLineAtOffset(140, 600);
                        contentStream.showText(sarreraOrdua);
                        contentStream.endText();
                        
                        //IrteeraOrduaren lerroa
                        posY -= lineSpacing;
                        contentStream.setFont(PDType1Font.HELVETICA_BOLD, 12);
                        contentStream.beginText();
                        contentStream.newLineAtOffset(50, 580);
                        contentStream.showText("Irteera ordua:");
                        contentStream.endText();

                        contentStream.setFont(PDType1Font.HELVETICA, 12);
                        contentStream.beginText();
                        contentStream.newLineAtOffset(135, 580);
                        contentStream.showText(irteeraOrdua);
                        contentStream.endText();
                        
                        //Prezioaren lerroa
                        posY -= lineSpacing;
                        contentStream.setFont(PDType1Font.HELVETICA_BOLD, 12);
                        contentStream.beginText();
                        contentStream.newLineAtOffset(50, 560);
                        contentStream.showText("Prezioa:");
                        contentStream.endText();

                        contentStream.setFont(PDType1Font.HELVETICA, 12);
                        contentStream.beginText();
                        contentStream.newLineAtOffset(105, 560);
                        contentStream.showText(prezioa + "€");
                        contentStream.endText();

                        //Lerro beltza irudikatu
                        contentStream.setStrokingColor(Color.BLACK);
                        contentStream.setLineWidth(1f);
                        contentStream.moveTo(50, posY - 10);
                        contentStream.lineTo(page.getMediaBox().getWidth() - 50, posY - 10);
                        contentStream.stroke();

                        //PDF-a gorde
                        contentStream.close();
                        document.save(fileToSave);
                        JOptionPane.showMessageDialog(null, "PDF-a ongi sortu eta gorde da: " + fileToSave.getAbsolutePath(), "Info", JOptionPane.INFORMATION_MESSAGE);
                    } catch(Exception ex) {
                       
                        JOptionPane.showMessageDialog(null, "Errorea PDF sortzean: " + ex.getMessage(), "Errorea", JOptionPane.ERROR_MESSAGE);
                    }
                }
            }
        });

        //Akzioa atzera botatzeko botoia
        ezeztatuButton.addActionListener(new ActionListener(){
            public void actionPerformed(ActionEvent e) {
                frame.dispose();  //Formularioa itxi
            }
        });

        frame.add(panel, BorderLayout.CENTER);
        frame.add(buttonPanel, BorderLayout.SOUTH);
        frame.pack();
        frame.setLocationRelativeTo(null);
        frame.setVisible(true);
    }
}