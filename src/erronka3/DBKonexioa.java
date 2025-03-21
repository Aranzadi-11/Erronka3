package erronka3;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;

//Datu basearekin konexioa

public class DBKonexioa {
    private static final String URL = "jdbc:mysql://172.16.237.120:3306/erronka3"; 
    private static final String USER = "Erronka";
    private static final String PASSWORD = "Erronka3"; 

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
