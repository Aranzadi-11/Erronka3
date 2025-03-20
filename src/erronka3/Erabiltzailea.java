package erronka3;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;

public class Erabiltzailea {
    public static boolean egiaztatuErabiltzailea(String erabiltzaileIzena, String pasahitza) {
        boolean baliozkoa = false;
        String sql = "SELECT * FROM langileak WHERE erabiltzaileIzena = ? AND pasahitza = ?";

        try (Connection konexioa = DBKonexioa.konektatu();
             PreparedStatement stmt = konexioa.prepareStatement(sql)) {

            stmt.setString(1, erabiltzaileIzena);
            stmt.setString(2, pasahitza);
            ResultSet rs = stmt.executeQuery();

            if (rs.next()) {
                baliozkoa = true;
            }

        } catch (SQLException e) {
            System.out.println("Errorea erabiltzailea egiaztatzean: " + e.getMessage());
        }
        return baliozkoa;
    }
}
