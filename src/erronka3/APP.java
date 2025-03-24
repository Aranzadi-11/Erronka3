package erronka3;

import javax.swing.*;
import javax.swing.border.EmptyBorder;
import java.awt.*;
import java.util.ArrayList;
import java.util.List;

// Aplikazioaren exekutablea
public class APP extends JFrame {
    private static final long serialVersionUID = 1L;
    private JPanel edukiontzia;
    private JPanel botoiakPanel;  // Eskuuineko botoiak
    private JPanel taulaPanel;     // Taula datuak erakusteko panela

    public APP(String userType) {
        // Leihoaren ezarpenak, tamaina handiagoa eta beti pantailaren erdian
        setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        setSize(1200, 800);
        setLocationRelativeTo(null);
        edukiontzia = new JPanel(new BorderLayout());
        edukiontzia.setBackground(Color.WHITE);
        setContentPane(edukiontzia);
        setTitle("Aplikazioa");

        // Taularen konfigurazioa, kolore txuria ezarri
        taulaPanel = new JPanel(new BorderLayout());
        taulaPanel.setBackground(Color.WHITE);
        taulaPanel.setBorder(new EmptyBorder(10, 10, 10, 10));

        // Eskuinaldeko botoien konfigurazioa, botoiak urdinak
        botoiakPanel = new JPanel();
        botoiakPanel.setLayout(new BoxLayout(botoiakPanel, BoxLayout.Y_AXIS));
        botoiakPanel.setBackground(Color.WHITE);
        botoiakPanel.setBorder(BorderFactory.createMatteBorder(0, 0, 0, 2, Color.BLACK));
        botoiakPanel.setPreferredSize(new Dimension(250, 800));

        // Erabiltzaile motaren arabera botoi batzuk sortu
        sortuBotoiak(userType);

        // Taula erdian edo ezkerraldera bota eta botoiak eskuinaldean 
        edukiontzia.add(taulaPanel, BorderLayout.CENTER);
        edukiontzia.add(botoiakPanel, BorderLayout.EAST);

        setVisible(true);
    }

    private void sortuBotoiak(String userType) {
        List<String> taulak = getTaulakErabiltzaileMota(userType);
        for (String taula : taulak) {
            JButton taulaBotoia = new JButton(taula.toUpperCase());
            taulaBotoia.setAlignmentX(Component.CENTER_ALIGNMENT);
            taulaBotoia.setMaximumSize(new Dimension(230, 600)); 
            taulaBotoia.setFont(new Font("Arial", Font.BOLD, 18));
            taulaBotoia.setForeground(Color.BLACK);
            taulaBotoia.setBackground(new Color(30, 144, 255));
            taulaBotoia.setFocusPainted(false);
            taulaBotoia.setBorder(BorderFactory.createLineBorder(Color.BLACK, 2));
            taulaBotoia.setCursor(new Cursor(Cursor.HAND_CURSOR));
            taulaBotoia.addActionListener(e -> erakutsiTaula(taula));
            
            botoiakPanel.add(Box.createVerticalStrut(15));
            botoiakPanel.add(taulaBotoia);
        }
        
        botoiakPanel.add(Box.createVerticalGlue());
        
        // "ITXI" botoia beheko eskumenean
        JButton exitBotoia = new JButton("ITXI");
        exitBotoia.setAlignmentX(Component.CENTER_ALIGNMENT);
        exitBotoia.setMaximumSize(new Dimension(230, 600));
        exitBotoia.setFont(new Font("Arial", Font.BOLD, 18));
        exitBotoia.setForeground(Color.BLACK);
        exitBotoia.setBackground(new Color(30, 144, 255));
        exitBotoia.setFocusPainted(false);
        exitBotoia.setBorder(BorderFactory.createLineBorder(Color.BLACK, 2));
        exitBotoia.setCursor(new Cursor(Cursor.HAND_CURSOR));
        exitBotoia.addActionListener(e -> System.exit(0));
        
        botoiakPanel.add(Box.createVerticalStrut(15));
        botoiakPanel.add(exitBotoia);
    }

    // Metodoa taula eremu dinamikoarekin erakusteko
    private void erakutsiTaula(String taulaIzena) {
        TaulaViewPanel taulaViewPanel = new TaulaViewPanel(taulaIzena);
        taulaPanel.removeAll();
        taulaPanel.add(taulaViewPanel, BorderLayout.CENTER);
        taulaPanel.revalidate();
        taulaPanel.repaint();
    }

    private List<String> getTaulakErabiltzaileMota(String userType) {
        List<String> taulak = new ArrayList<>();
        switch (userType) {
            case "Administratzailea":
                taulak.add("bezeroak");
                taulak.add("erreserbak");
                taulak.add("langileak");
                taulak.add("logelak");
                taulak.add("zerbitsuak");
                break;
            case "Informatikaria":
                taulak.add("bezeroak");
                taulak.add("erreserbak");
                taulak.add("logelak");
                taulak.add("zerbitsuak");
                break;
            case "Harreragilea":
                taulak.add("bezeroak");
                taulak.add("erreserbak");
                break;
            default:
                break;
        }
        return taulak;
    }
}
