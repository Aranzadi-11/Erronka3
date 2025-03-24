package erronka3;

import java.sql.*;
import java.util.ArrayList;
import java.util.List;

public class DBAukerak {
    // Logelak taulatik "izena" array bezala lortzeko
    public static String[] getLogelaIzenaArray() {
        List<String> izenak = new ArrayList<>();
        String sql = "SELECT izena FROM logelak";
        try (Connection con = DBKonexioa.konektatu();
             Statement stmt = con.createStatement();
             ResultSet rs = stmt.executeQuery(sql)) {
            while(rs.next()){
                izenak.add(rs.getString("izena"));
            }
        } catch (SQLException e) {
            System.out.println("Errorea logela izenak hartzean: " + e.getMessage());
        }
        return izenak.toArray(new String[0]);
    }
    
    // Logela baten arabera, erreserbatu dituzten bezeroen "erabiltzaileIzena" array
    public static String[] getBezeroErreserbatuArray(String logelaIzena) {
        List<String> izenak = new ArrayList<>();
        String sql = "SELECT DISTINCT bez.erabiltzaileIzena FROM erreserbak AS err " +
                     "JOIN bezeroak AS bez ON err.idBezeroa = bez.idBezeroa " +
                     "JOIN logelak AS log ON err.idLogela = log.idLogela " +
                     "WHERE log.izena = ?";
        try (Connection con = DBKonexioa.konektatu();
             PreparedStatement pst = con.prepareStatement(sql)) {
            pst.setString(1, logelaIzena);
            ResultSet rs = pst.executeQuery();
            while(rs.next()){
                izenak.add(rs.getString("erabiltzaileIzena"));
            }
        } catch (SQLException e) {
            System.out.println("Errorea bezero izenak hartzean: " + e.getMessage());
        }
        return izenak.toArray(new String[0]);
    }
    
    // Logela eta bezeroaren arabera, erreserba datak array
    public static String[] getErreserbaDataArray(String logelaIzena, String bezeroIzena) {
        List<String> datak = new ArrayList<>();
        String sql = "SELECT err.erreserbaEguna FROM erreserbak AS err " +
                     "JOIN bezeroak AS bez ON err.idBezeroa = bez.idBezeroa " +
                     "JOIN logelak AS log ON err.idLogela = log.idLogela " +
                     "WHERE log.izena = ? AND bez.erabiltzaileIzena = ?";
        try (Connection con = DBKonexioa.konektatu();
             PreparedStatement pst = con.prepareStatement(sql)) {
            pst.setString(1, logelaIzena);
            pst.setString(2, bezeroIzena);
            ResultSet rs = pst.executeQuery();
            while(rs.next()){
                datak.add(rs.getString("erreserbaEguna"));
            }
        } catch (SQLException e) {
            System.out.println("Errorea erreserba datak hartzean: " + e.getMessage());
        }
        return datak.toArray(new String[0]);
    }
    
    // Logela, bezeroaren eta erreserba eguna arabera, erreserba informazioa (sarreraEguna, irteeraEguna, sarreraOrdua, irteeraOrdua, Prezioa)
    public static String[] getErreserbaInformazioa(String logelaIzena, String bezeroIzena, String erreserbaEguna) {
        List<String> informazioa = new ArrayList<>();
        String sql = "SELECT err.sarreraEguna, err.irteeraEguna, err.sarreraOrdua, err.irteeraOrdua, err.prezioa " +
                     "FROM erreserbak AS err " +
                     "JOIN bezeroak AS bez ON err.idBezeroa = bez.idBezeroa " +
                     "JOIN logelak AS log ON err.idLogela = log.idLogela " +
                     "WHERE log.izena = ? AND bez.erabiltzaileIzena = ? AND err.erreserbaEguna = ?";
        try (Connection con = DBKonexioa.konektatu();
             PreparedStatement pst = con.prepareStatement(sql)) {
            pst.setString(1, logelaIzena);
            pst.setString(2, bezeroIzena);
            pst.setString(3, erreserbaEguna);

            ResultSet rs = pst.executeQuery();
            while(rs.next()){
                // Añadimos los resultados a la lista
                informazioa.add(rs.getString("sarreraEguna"));
                informazioa.add(rs.getString("irteeraEguna"));
                informazioa.add(rs.getString("sarreraOrdua"));
                informazioa.add(rs.getString("irteeraOrdua"));
                informazioa.add(rs.getString("prezioa"));
            }
        } catch (SQLException e) {
            System.out.println("Errorea erreserba informazioa hartzean: " + e.getMessage());
        }
        return informazioa.toArray(new String[0]);
    }
}
