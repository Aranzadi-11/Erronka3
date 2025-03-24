package erronka3;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.SQLException;
import java.util.HashMap;
import java.util.Map;

public class Ekintzak {
    // Ezabatu erregistroa
    public static boolean ezabatu(String taulaIzena, String idKatea, String idBalioa) {
        String sql = "DELETE FROM " + taulaIzena + " WHERE " + idKatea + " = ?";
        try (Connection con = DBKonexioa.konektatu();
             PreparedStatement pst = con.prepareStatement(sql)) {
            pst.setString(1, idBalioa);
            int erregistroKop = pst.executeUpdate();
            return erregistroKop > 0;
        } catch (SQLException e) {
            System.out.println("Errorea ezabatzean: " + e.getMessage());
            return false;
        }
    }
    
    // Eguneratu erregistroa
    public static boolean eguneratu(String taulaIzena, HashMap<String, String> datuak, String idKatea, String idBalioa) {
        StringBuilder sql = new StringBuilder("UPDATE " + taulaIzena + " SET ");
        int kont = 0;
        for (Map.Entry<String, String> entry : datuak.entrySet()) {
            if (kont > 0) {
                sql.append(", ");
            }
            sql.append(entry.getKey()).append(" = ?");
            kont++;
        }
        sql.append(" WHERE ").append(idKatea).append(" = ?");
        try (Connection con = DBKonexioa.konektatu();
             PreparedStatement pst = con.prepareStatement(sql.toString())) {
            int i = 1;
            for (Map.Entry<String, String> entry : datuak.entrySet()) {
                pst.setString(i++, entry.getValue());
            }
            pst.setString(i, idBalioa);
            int erregistroKop = pst.executeUpdate();
            return erregistroKop > 0;
        } catch (SQLException e) {
            System.out.println("Errorea eguneratzean: " + e.getMessage());
            return false;
        }
    }
    
    // Gehitu erregistroa
    public static boolean gehitu(String taulaIzena, HashMap<String, String> datuak) {
        StringBuilder sql = new StringBuilder("INSERT INTO " + taulaIzena + " (");
        StringBuilder placeholders = new StringBuilder();
        int kont = 0;
        for (String zut : datuak.keySet()) {
            if (kont > 0) {
                sql.append(", ");
                placeholders.append(", ");
            }
            sql.append(zut);
            placeholders.append("?");
            kont++;
        }
        sql.append(") VALUES (").append(placeholders).append(")");
        try (Connection con = DBKonexioa.konektatu();
             PreparedStatement pst = con.prepareStatement(sql.toString())) {
            int i = 1;
            for (String zut : datuak.keySet()) {
                pst.setString(i++, datuak.get(zut));
            }
            int erregistroKop = pst.executeUpdate();
            return erregistroKop > 0;
        } catch (SQLException e) {
            System.out.println("Errorea gehitzean: " + e.getMessage());
            return false;
        }
    }
}
