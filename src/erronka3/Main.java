package erronka3;

import java.util.HashMap;

public class Main {
    public static void main(String[] args) {
        //Logelaren datuak sartu
        HashMap<String, String> logelaData = new HashMap<>();
        logelaData.put("izena", "Deluxe Logela");
        logelaData.put("gelaEdukiera", "5");
        logelaData.put("deskripzioa", "Itsasora bistak dituen logela");
        logelaData.put("prezioa", "150");

        //Datu basean aldaketak gorde
        boolean success = Ekintzak.gehituOBP("logelak", logelaData);

        if (success) {
            System.out.println("Logela ondo erantsi da datu basean.");
        } else {
            System.out.println("Akats bat gertatu da logela datu basean eransterako garaian.");
        }
    }
}