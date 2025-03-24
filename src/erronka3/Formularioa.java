package erronka3;

import javax.swing.*;
import java.awt.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.util.HashMap;

public class Formularioa {

    public static void mostrarFormulario(String taulaIzena, String modua, String idKatea, String idBalioa, String[] errenkada, Runnable onSuccess) {
        JFrame frame = new JFrame("Formulario - " + taulaIzena);
        frame.setDefaultCloseOperation(JFrame.DISPOSE_ON_CLOSE);
        frame.setLayout(new BorderLayout());
        
        JPanel formPanel = new JPanel();
        formPanel.setLayout(new GridBagLayout());
        formPanel.setBackground(Color.WHITE);
        GridBagConstraints gbc = new GridBagConstraints();
        gbc.insets = new Insets(5,5,5,5);
        gbc.fill = GridBagConstraints.HORIZONTAL;
        
        // Erabili TauleenDatuak modeloak zutabe izenak lortzeko
        TauleenDatuak modelo = new TauleenDatuak(taulaIzena);
        int kolCount = modelo.getColumnCount();
        
        JTextField[] fields = new JTextField[kolCount - 1]; // lehen zutabea (id) baztertuta
        int fieldIndex = 0;
        for (int i = 1; i < kolCount; i++) {
            gbc.gridx = 0;
            gbc.gridy = fieldIndex;
            String zutName = modelo.getColumnName(i);
            formPanel.add(new JLabel(zutName + ":"), gbc);
            
            gbc.gridx = 1;
            JTextField textField = new JTextField(15);
            // Prefill eremuak eguneratzean edo gehitzean (hautatutako errenkadaren datuak)
            if (errenkada != null && errenkada.length > i) {
                textField.setText(errenkada[i]);
            }
            fields[fieldIndex] = textField;
            formPanel.add(textField, gbc);
            fieldIndex++;
        }
        
        JPanel buttonPanel = new JPanel();
        buttonPanel.setBackground(Color.WHITE);
        JButton gordeButton = new JButton("Gorde");
        JButton ezeztatuButton = new JButton("Ezeztatu");
        
        buttonPanel.add(gordeButton);
        buttonPanel.add(ezeztatuButton);
        
        frame.add(formPanel, BorderLayout.CENTER);
        frame.add(buttonPanel, BorderLayout.SOUTH);
        
        gordeButton.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent e) {
                HashMap<String, String> datuak = new HashMap<>();
                for (int i = 1; i < kolCount; i++) {
                    String zut = modelo.getColumnName(i);
                    String balioa = fields[i-1].getText();
                    datuak.put(zut, balioa);
                }
                boolean ondo = false;
                if (modua.equals("eguneratu")) {
                    ondo = Ekintzak.eguneratu(taulaIzena, datuak, idKatea, idBalioa);
                } else if (modua.equals("gehitu")) {
                    ondo = Ekintzak.gehitu(taulaIzena, datuak);
                }
                if (ondo) {
                    JOptionPane.showMessageDialog(null, "Datuak ongi gorde dira.", "Info", JOptionPane.INFORMATION_MESSAGE);
                    frame.dispose();
                    if (onSuccess != null) {
                        onSuccess.run();
                    }
                } else {
                    JOptionPane.showMessageDialog(null, "Errorea datuak gordetzean.", "Errorea", JOptionPane.ERROR_MESSAGE);
                }
            }
        });
        
        ezeztatuButton.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent e) {
                frame.dispose();
            }
        });
        
        frame.pack();
        frame.setLocationRelativeTo(null);
        frame.setVisible(true);
    }
}
