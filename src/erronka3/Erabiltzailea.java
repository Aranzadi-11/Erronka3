package erronka3;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.HashMap;

/**
 * Erabiltzaileen autentifikazio logika kudeatzen duen klasea.
 */
public class Erabiltzailea {

    /**
     * Erabiltzailearen kredentzialak datu-basean egiaztatzen ditu.
     * @param erabiltzaileIzena Erabiltzaile izena.
     * @param pasahitza Pasahitza.
     * @return HashMap bat non erabiltzailearen datuak (izena eta mota) dauden, autentifikazioa oker bada hutsik.
     */
    public static HashMap<String, String> egiaztatuErabiltzailea(String erabiltzaileIzena, String pasahitza) {
        HashMap<String, String> erabiltzaileDatuak = new HashMap<>();
        String sql = "SELECT izena, erabiltzaileMota FROM langileak WHERE erabiltzaileIzena = ? AND pasahitza = ?";

        try (Connection konexioa = DBKonexioa.konektatu();
             PreparedStatement stmt = konexioa.prepareStatement(sql)) {
            
            stmt.setString(1, erabiltzaileIzena);
            stmt.setString(2, pasahitza);
            ResultSet rs = stmt.executeQuery();

            if (rs.next()) {
                erabiltzaileDatuak.put("izena", rs.getString("izena"));
                erabiltzaileDatuak.put("erabiltzaileMota", rs.getString("erabiltzaileMota"));
            }
        } catch (SQLException e) {
            System.out.println("Errorea erabiltzailea egiaztatzean: " + e.getMessage());
        }
        return erabiltzaileDatuak;
    }
}
