package erronka3;

import javax.swing.*;
import java.awt.*;

public class TaulaViewPanel extends JPanel {
    private String taulaIzena;
    private JTable table;
    private JScrollPane scrollPane;
    private TaulenBotoiak botoiak;

    public TaulaViewPanel(String taulaIzena) {
        this.taulaIzena = taulaIzena;
        setLayout(new BorderLayout());
        setBackground(Color.WHITE);
        // Sortu taula: TauleenDatuak modelo erabili
        table = new JTable(new TauleenDatuak(taulaIzena));
        table.setSelectionMode(ListSelectionModel.SINGLE_SELECTION);
        table.setFont(new Font("Arial", Font.PLAIN, 14));
        table.setRowHeight(25);
        scrollPane = new JScrollPane(table);
        scrollPane.getViewport().setBackground(Color.WHITE);
        scrollPane.setBorder(BorderFactory.createLineBorder(Color.BLACK, 2));
        add(scrollPane, BorderLayout.CENTER);
        
        // Sortu botoiak panela
        botoiak = new TaulenBotoiak(taulaIzena, this);
        add(botoiak.getBotoiakPanel(), BorderLayout.SOUTH);
    }
    
    // Metodoa aukeratutako errenkada datuak lortzeko
    public String[] getAukeratutakoErrenkada() {
        int row = table.getSelectedRow();
        if (row != -1) {
            int colCount = table.getColumnCount();
            String[] errenkada = new String[colCount];
            for (int i = 0; i < colCount; i++) {
                errenkada[i] = table.getValueAt(row, i).toString();
            }
            return errenkada;
        }
        return null;
    }
    
    // Taula berrizkargatzeko
    public void berrizkargatuTaula() {
        table.setModel(new TauleenDatuak(taulaIzena));
    }
    
    public String getTaulaIzena() {
        return taulaIzena;
    }
}
