package erronka3;

import javax.swing.*;
import javax.swing.border.EmptyBorder;
import java.awt.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

public class Login extends JFrame {
    private static final long serialVersionUID = 1L;
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
        setSize(400, 300);
        setLocationRelativeTo(null);
        setResizable(false);

        JPanel contentPane = new JPanel();
        contentPane.setBorder(new EmptyBorder(20, 20, 20, 20));
        contentPane.setBackground(Color.WHITE);
        contentPane.setLayout(new BorderLayout());
        setContentPane(contentPane);

        // Titulo
        JLabel lblTitulo = new JLabel("Ongi Etorri", SwingConstants.CENTER);
        lblTitulo.setFont(new Font("Arial", Font.BOLD, 24));
        lblTitulo.setForeground(new Color(30, 144, 255));
        contentPane.add(lblTitulo, BorderLayout.NORTH);

        // Formulario
        JPanel panelFormulario = new JPanel(new GridBagLayout());
        panelFormulario.setBackground(Color.WHITE);
        GridBagConstraints gbc = new GridBagConstraints();
        gbc.insets = new Insets(10, 10, 10, 10);
        gbc.fill = GridBagConstraints.HORIZONTAL;

        JLabel lblErabiltzaileIzena = new JLabel("Erabiltzaile Izena:");
        lblErabiltzaileIzena.setFont(new Font("Arial", Font.PLAIN, 14));
        gbc.gridx = 0;
        gbc.gridy = 0;
        panelFormulario.add(lblErabiltzaileIzena, gbc);

        erabiltzaileIzenaField = new JTextField(15);
        erabiltzaileIzenaField.setFont(new Font("Arial", Font.PLAIN, 14));
        gbc.gridx = 1;
        panelFormulario.add(erabiltzaileIzenaField, gbc);

        JLabel lblPasahitza = new JLabel("Pasahitza:");
        lblPasahitza.setFont(new Font("Arial", Font.PLAIN, 14));
        gbc.gridx = 0;
        gbc.gridy = 1;
        panelFormulario.add(lblPasahitza, gbc);

        pasahitzaField = new JPasswordField(15);
        pasahitzaField.setFont(new Font("Arial", Font.PLAIN, 14));
        gbc.gridx = 1;
        panelFormulario.add(pasahitzaField, gbc);

        contentPane.add(panelFormulario, BorderLayout.CENTER);

        // Botoia
        JButton btnLogin = new JButton("Saioa Hasi");
        btnLogin.setFont(new Font("Arial", Font.BOLD, 14));
        btnLogin.setForeground(Color.WHITE);
        btnLogin.setBackground(new Color(30, 144, 255));
        btnLogin.setBorder(BorderFactory.createEmptyBorder(10, 20, 10, 20));
        btnLogin.setFocusPainted(false);
        btnLogin.setCursor(new Cursor(Cursor.HAND_CURSOR));
        
        JPanel panelBotoia = new JPanel();
        panelBotoia.setBackground(Color.WHITE);
        panelBotoia.add(btnLogin);
        contentPane.add(panelBotoia, BorderLayout.SOUTH);

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