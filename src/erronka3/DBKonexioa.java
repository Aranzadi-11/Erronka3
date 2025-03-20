package erronka3;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;

public class DBKonexioa {

    private static final String URL = "jdbc:mysql://localhost:3306/erronka3"; 
    private static final String USER = "root";
    private static final String PASSWORD = ""; 

    public static Connection konektatu() {
        Connection konexioa = null;
        try {
            konexioa = DriverManager.getConnection(URL, USER, PASSWORD);
            System.out.println("Konexioa arrakastatsua!");
        } catch (SQLException e) {
            System.out.println("Errorea konexioan: " + e.getMessage());
        }
        return konexioa;
    }
}
