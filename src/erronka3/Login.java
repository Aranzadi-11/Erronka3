package erronka3;

import javax.swing.border.EmptyBorder;

import javax.swing.*;
import java.awt.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

public class Login extends JFrame {
    private static final long serialVersionUID = 1L;
    private JPanel contentPane;
    private JTextField erabiltzaileIzenaField;
    private JPasswordField pasahitzaField;

    public static void main(String[] args) {
        EventQueue.invokeLater(() -> {
            try {
                Login frame = new Login();
                frame.setVisible(true);
            } catch (Exception e) {
                e.printStackTrace();
            }
        });
    }

    public Login() {
        setTitle("Saioa Hasi");
        setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        setBounds(100, 100, 350, 200);
        contentPane = new JPanel();
        contentPane.setBorder(new EmptyBorder(5, 5, 5, 5));
        setContentPane(contentPane);
        contentPane.setLayout(new GridLayout(3, 2, 5, 5));

        JLabel lblErabiltzaileIzena = new JLabel("Erabiltzaile Izena:");
        contentPane.add(lblErabiltzaileIzena);

        erabiltzaileIzenaField = new JTextField();
        contentPane.add(erabiltzaileIzenaField);
        erabiltzaileIzenaField.setColumns(10);

        JLabel lblPasahitza = new JLabel("Pasahitza:");
        contentPane.add(lblPasahitza);

        pasahitzaField = new JPasswordField();
        contentPane.add(pasahitzaField);

        JButton btnLogin = new JButton("Saioa Hasi");
        contentPane.add(btnLogin);

        btnLogin.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent e) {
                String erabiltzaileIzena = erabiltzaileIzenaField.getText();
                String pasahitza = new String(pasahitzaField.getPassword());

                if (Erabiltzailea.egiaztatuErabiltzailea(erabiltzaileIzena, pasahitza)) {
                    JOptionPane.showMessageDialog(null, "Saioa ongi hasi da!");
                    dispose(); // Login itxi
                    new APP(); // Aplikazioa ireki
                } else {
                    JOptionPane.showMessageDialog(null, "Erabiltzailea edo pasahitza okerra!", "Errorea", JOptionPane.ERROR_MESSAGE);
                }
            }
        });
    }
}
