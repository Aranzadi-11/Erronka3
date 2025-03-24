package erronka3;

import javax.swing.*;
import java.awt.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.util.HashMap;

public class TaulenBotoiak {
    private JPanel botoiakPanel;
    private TaulaViewPanel taulaView;
    private String taulaIzena;
    
    public TaulenBotoiak(String taulaIzena, TaulaViewPanel taulaView) {
        this.taulaIzena = taulaIzena;
        this.taulaView = taulaView;
        botoiakPanel = new JPanel();
        botoiakPanel.setLayout(new FlowLayout(FlowLayout.CENTER));
        botoiakPanel.setBackground(Color.WHITE);
        sortuBotoiak();
    }
    
    private void sortuBotoiak() {
        switch (taulaIzena) {
            case "bezeroak":
                botoiakPanel.add(createButton("Ezabatu", new ActionListener() {
                    public void actionPerformed(ActionEvent e) {
                        ezabatuErregistroa("idBezeroa");
                    }
                }));
                botoiakPanel.add(createButton("Eguneratu", new ActionListener() {
                    public void actionPerformed(ActionEvent e) {
                        eguneratuErregistroa("idBezeroa");
                    }
                }));
                break;
            case "langileak":
                botoiakPanel.add(createButton("Gehitu", new ActionListener() {
                    public void actionPerformed(ActionEvent e) {
                        gehituErregistroa("idLangilea");
                    }
                }));
                botoiakPanel.add(createButton("Ezabatu", new ActionListener() {
                    public void actionPerformed(ActionEvent e) {
                        ezabatuErregistroa("idLangilea");
                    }
                }));
                botoiakPanel.add(createButton("Eguneratu", new ActionListener() {
                    public void actionPerformed(ActionEvent e) {
                        eguneratuErregistroa("idLangilea");
                    }
                }));
                break;
            case "erreserbak":
                botoiakPanel.add(createButton("PDF-a sortu", new ActionListener() {
                    public void actionPerformed(ActionEvent e) {
                        PDFSortzailea.mostrarFormulario();
                    }
                }));
                break;
            case "logelak":
                botoiakPanel.add(createButton("Gehitu", new ActionListener() {
                    public void actionPerformed(ActionEvent e) {
                        gehituErregistroa("idLogela");
                    }
                }));
                botoiakPanel.add(createButton("Ezabatu", new ActionListener() {
                    public void actionPerformed(ActionEvent e) {
                        ezabatuErregistroa("idLogela");
                    }
                }));
                botoiakPanel.add(createButton("Eguneratu", new ActionListener() {
                    public void actionPerformed(ActionEvent e) {
                        eguneratuErregistroa("idLogela");
                    }
                }));
                break;
            case "zerbitsuak":
                botoiakPanel.add(createButton("Gehitu", new ActionListener() {
                    public void actionPerformed(ActionEvent e) {
                        gehituErregistroa("idZerbitzua");
                    }
                }));
                botoiakPanel.add(createButton("Ezabatu", new ActionListener() {
                    public void actionPerformed(ActionEvent e) {
                        ezabatuErregistroa("idZerbitzua");
                    }
                }));
                botoiakPanel.add(createButton("Eguneratu", new ActionListener() {
                    public void actionPerformed(ActionEvent e) {
                        eguneratuErregistroa("idZerbitzua");
                    }
                }));
                break;
        }
    }
    
    // Botoi bat sortzeko metodo laguntzailea
    private JButton createButton(String text, ActionListener action) {
        JButton button = new JButton(text);
        button.setFont(new Font("Arial", Font.BOLD, 14));
        button.setForeground(Color.BLACK);
        button.setBackground(new Color(30, 144, 255));
        button.setFocusPainted(false);
        button.setCursor(new Cursor(Cursor.HAND_CURSOR));
        button.addActionListener(action);
        return button;
    }
    
    // Ezabatzeko funtzioa
    private void ezabatuErregistroa(String idKatea) {
        String[] errenkada = taulaView.getAukeratutakoErrenkada();
        if (errenkada == null) {
            JOptionPane.showMessageDialog(null, "Mesedez, hautatu erregistro bat ezabatzeko.", "Errorea", JOptionPane.ERROR_MESSAGE);
            return;
        }
        String idBalioa = errenkada[0]; // Asume lehen zutabea da id
        int erantzuna = JOptionPane.showConfirmDialog(null, "Ziur zaude ezabatu nahi duzula erregistroa: " + idBalioa + " ?", "Konfirmatu", JOptionPane.YES_NO_OPTION);
        if (erantzuna == JOptionPane.YES_OPTION) {
            boolean ondo = Ekintzak.ezabatu(taulaIzena, idKatea, idBalioa);
            if (ondo) {
                JOptionPane.showMessageDialog(null, "Erregistroa ongi ezabatua.", "Info", JOptionPane.INFORMATION_MESSAGE);
                taulaView.berrizkargatuTaula();
            } else {
                JOptionPane.showMessageDialog(null, "Errorea ezabatzean.", "Errorea", JOptionPane.ERROR_MESSAGE);
            }
        }
    }
    
    // Eguneratzeko funtzioa
    private void eguneratuErregistroa(String idKatea) {
        String[] errenkada = taulaView.getAukeratutakoErrenkada();
        if (errenkada == null) {
            JOptionPane.showMessageDialog(null, "Mesedez, hautatu erregistro bat eguneratzeko.", "Errorea", JOptionPane.ERROR_MESSAGE);
            return;
        }
        String idBalioa = errenkada[0];
        Formularioa.mostrarFormulario(taulaIzena, "eguneratu", idKatea, idBalioa, errenkada, new Runnable(){
            public void run() {
                taulaView.berrizkargatuTaula();
            }
        });
    }
    
    // Gehitzeko funtzioa
    private void gehituErregistroa(String idKatea) {
        String[] errenkada = taulaView.getAukeratutakoErrenkada();
        Formularioa.mostrarFormulario(taulaIzena, "gehitu", idKatea, null, errenkada, new Runnable(){
            public void run() {
                taulaView.berrizkargatuTaula();
            }
        });
    }
    
    public JPanel getBotoiakPanel() {
        return botoiakPanel;
    }
}
