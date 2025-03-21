package erronka3;

import javax.swing.*;
import javax.swing.border.EmptyBorder;
import javax.swing.table.JTableHeader;
import java.awt.*;
import java.util.ArrayList;
import java.util.List;

/**
 * Aplikazioko leiho nagusia: taula eremu nagusia eta eskumenean botoi panela.
 * Botoiak, taula goiko eremua eta bestelako elementuak eguneratu dira
 * erabilerari errazago eta atseginago erakusteko.
 */
public class APP extends JFrame {
    private static final long serialVersionUID = 1L;
    private JPanel edukiontzia;
    private JPanel botoiakPanel;  // Eskumenean dauden botoiak
    private JPanel taulaPanel;     // Taula datuak erakusteko panela

    public APP(String userType) {
        // Leihoaren ezarpenak: tamaina handiagoa eta beti pantailaren erdian
        setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        setSize(1200, 800);
        setLocationRelativeTo(null);
        edukiontzia = new JPanel(new BorderLayout());
        edukiontzia.setBackground(Color.WHITE);
        setContentPane(edukiontzia);
        setTitle("Aplikazioa");

        // Taula panela: gainerako espazioa, funtsezko eremu nagusia (zuria)
        taulaPanel = new JPanel(new BorderLayout());
        taulaPanel.setBackground(Color.WHITE);
        taulaPanel.setBorder(new EmptyBorder(10, 10, 10, 10));

        // Botoiak panela: leihoaren eskumenean, urdin kolore sendoarekin
        botoiakPanel = new JPanel();
        botoiakPanel.setLayout(new BoxLayout(botoiakPanel, BoxLayout.Y_AXIS));
        botoiakPanel.setBackground(Color.WHITE);
        botoiakPanel.setBorder(BorderFactory.createMatteBorder(0, 0, 0, 2, Color.BLACK));
        botoiakPanel.setPreferredSize(new Dimension(250, 800));

        // Botoiak sortu, erabiltzaile mota arabera + ITXI botoia
        sortuBotoiak(userType);

        // Leihoan ezarri: taula panela ezkerrean (edo zentrora) eta botoiak eskuinean
        edukiontzia.add(taulaPanel, BorderLayout.CENTER);
        edukiontzia.add(botoiakPanel, BorderLayout.EAST);

        setVisible(true);
    }

    private void sortuBotoiak(String userType) {
        List<String> taulak = getTaulakErabiltzaileMota(userType);
        
        // Gehitu aukeratutako taula botoiak
        for (String taula : taulak) {
            JButton taulaBotoia = new JButton(taula.toUpperCase());
            // Botoi handiak eta erakargarriak:
            // - Oso urdin botoi osoa
            // - Testua beltza
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
        
        // Espazio betetzeko botoien artean
        botoiakPanel.add(Box.createVerticalGlue());
        
        // Gehitu "ITXI" botoia beheko eskumenean
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

    private void erakutsiTaula(String taulaIzena) {
        JTable table = new JTable();
        // Taula betetzeko datuak datu-basetik
        table.setModel(new TauleenDatuak(taulaIzena));
        table.setFillsViewportHeight(true);
        table.setFont(new Font("Arial", Font.PLAIN, 14));
        table.setRowHeight(25);
        table.setForeground(Color.BLACK);
        table.setBackground(Color.WHITE);
        table.setGridColor(Color.BLACK);

        // Taula goiko eremu (header) aldaketak: urdin background eta beltza testua
        JTableHeader header = table.getTableHeader();
        header.setBackground(new Color(30, 144, 255));
        header.setForeground(Color.BLACK);
        header.setFont(new Font("Arial", Font.BOLD, 16));
        header.setBorder(BorderFactory.createLineBorder(Color.BLACK, 2));

        // Scroll panela, fondo zuri
        JScrollPane scrollPane = new JScrollPane(table);
        scrollPane.getViewport().setBackground(Color.WHITE);
        scrollPane.setBorder(BorderFactory.createLineBorder(Color.BLACK, 2));
        
        taulaPanel.removeAll();
        taulaPanel.add(scrollPane, BorderLayout.CENTER);
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
                taulak.add("zerbitzuak");
                break;
            case "Informatikaria":
                taulak.add("bezeroak");
                taulak.add("erreserbak");
                taulak.add("logelak");
                taulak.add("zerbitzuak");
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
