package erronka3;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.SQLException;
import java.util.HashMap;

public class OBPKlasea {

    private Connection connection;

    public OBPKlasea() {
        this.connection = DBKonexioa.konektatu();
    }

    public boolean insertData(String tableName, HashMap<String, String> data) {
        StringBuilder sql = new StringBuilder("INSERT INTO ").append(tableName).append(" (");
        StringBuilder placeholders = new StringBuilder();
        int count = 0;

        for (String column : data.keySet()) {
            if (count > 0) {
                sql.append(", ");
                placeholders.append(", ");
            }
            sql.append(column);
            placeholders.append("?");
            count++;
        }

        sql.append(") VALUES (").append(placeholders).append(")");

        try (PreparedStatement pst = connection.prepareStatement(sql.toString())) {
            int i = 1;
            for (String value : data.values()) {
                pst.setString(i++, value);
            }

            int rowsAffected = pst.executeUpdate();
            return rowsAffected > 0;
        } catch (SQLException e) {
            System.out.println("Error inserting data: " + e.getMessage());
            return false;
        }
    }

    public void closeConnection() {
        try {
            if (connection != null && !connection.isClosed()) {
                connection.close();
            }
        } catch (SQLException e) {
            System.out.println("Error closing connection: " + e.getMessage());
        }
    }
}