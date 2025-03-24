package erronka3;

import javax.swing.table.AbstractTableModel;
import java.sql.*;
import java.util.ArrayList;
import java.util.List;

//Taula datuak datu-basetik eraman eta JTable-ra egokitzen duen modelo klasea.

public class TaulaErakuslea extends AbstractTableModel {
    private static final long serialVersionUID = 1L;
    private String taulaIzena;
    private List<String[]> errenkadak = new ArrayList<>();
    private String[] zutabeak;

    public TaulaErakuslea(String taulaIzena) {
        this.taulaIzena = taulaIzena;
        datuakErosi();
    }

    private void datuakErosi() {
        String sql = "SELECT * FROM " + taulaIzena;
        try (Connection con = DBKonexioa.konektatu();
             Statement stmt = con.createStatement();
             ResultSet rs = stmt.executeQuery(sql)) {

            //Zutabeen izenak lortu
            ResultSetMetaData metaData = rs.getMetaData();
            int zutabeKopurua = metaData.getColumnCount();
            zutabeak = new String[zutabeKopurua];
            for (int i = 1; i <= zutabeKopurua; i++) {
                zutabeak[i - 1] = metaData.getColumnName(i);
            }

            //Errenkada guztia lortu
            while (rs.next()) {
                String[] errenkada = new String[zutabeKopurua];
                for (int i = 1; i <= zutabeKopurua; i++) {
                    errenkada[i - 1] = rs.getString(i);
                }
                errenkadak.add(errenkada);
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
    }

    @Override
    public int getRowCount() {
        return errenkadak.size();
    }

    @Override
    public int getColumnCount() {
        return zutabeak.length;
    }

    @Override
    public Object getValueAt(int rowIndex, int columnIndex) {
        return errenkadak.get(rowIndex)[columnIndex];
    }

    @Override
    public String getColumnName(int column) {
        return zutabeak[column];
    }
}
