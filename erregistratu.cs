using System;

using System.Windows.Forms;

using MySql.Data.MySqlClient;

namespace BezeroenAPP

{

    public partial class Erregistratu : Form
    {
        private DBKonexioa dbKonexioa;

        public Erregistratu()

        {
            InitializeComponent();
            dbKonexioa = new DBKonexioa(); //DBKonexioa klasea ireki
        }

        private void btnErregistratu_Click(object sender, EventArgs e)

        {

            //Datuak jaso
            string izena = txtIzena.Text;
            string abizena = txtAbizena.Text;
            string erabiltzaileIzena = txtErabiltzaileIzena.Text;
            string pasahitza = txtPasahitza.Text;
            string jaiotzeData = txtJaiotzeData.Text;
            string emaila = txtEmaila.Text;

            //Datuen balidazioa
            if (string.IsNullOrWhiteSpace(izena) || string.IsNullOrWhiteSpace(abizena) || string.IsNullOrWhiteSpace(erabiltzaileIzena)

                || string.IsNullOrWhiteSpace(pasahitza) || string.IsNullOrWhiteSpace(jaiotzeData) || string.IsNullOrWhiteSpace(emaila))

            {
                MessageBox.Show("Mesedez, bete guztiak eremuak.", "Errorea", MessageBoxButtons.OK, MessageBoxIcon.Error);
                return;
            }

            //Jaiotze data balidatu (YYYY/MM/DD formatua izan behar du)
            if (!System.Text.RegularExpressions.Regex.IsMatch(jaiotzeData, @"^\d{4}/\d{2}/\d{2}$"))
            {
                MessageBox.Show("Jaiotze data egonkorra izan behar du (YYYY/MM/DD formatua).", "Errorea", MessageBoxButtons.OK, MessageBoxIcon.Error);
                return;
            }

            //emaila balidatu
            if (!emaila.Contains("@"))
            {
                MessageBox.Show("Emailak '@' izan behar du.", "Errorea", MessageBoxButtons.OK, MessageBoxIcon.Error);
                return;
            }

            //Konexioa ireki
            MySqlConnection conn = dbKonexioa.GetConnection();

            try
            {
                conn.Open();

                //kontsulta prestatu
                string query = "INSERT INTO bezeroak (izena, abizena, erabiltzaileIzena, pasahitza, jaiotzeEguna, emaila) " +
                               "VALUES (@izena, @abizena, @erabiltzaileIzena, @pasahitza, @jaiotzeEguna, @emaila)";

                using (MySqlCommand cmd = new MySqlCommand(query, conn))
                {
                    //Insert parametrotan datuak sartu
                    cmd.Parameters.AddWithValue("@izena", izena);
                    cmd.Parameters.AddWithValue("@abizena", abizena);
                    cmd.Parameters.AddWithValue("@erabiltzaileIzena", erabiltzaileIzena);
                    cmd.Parameters.AddWithValue("@pasahitza", pasahitza);
                    cmd.Parameters.AddWithValue("@jaiotzeEguna", jaiotzeData);
                    cmd.Parameters.AddWithValue("@emaila", emaila);

                    //Kontsulta ejekutatu
                    int rowsAffected = cmd.ExecuteNonQuery();

                    if (rowsAffected > 0)
                    {
                        MessageBox.Show("Erabiltzailea gordeta", "Arrakasta", MessageBoxButtons.OK, MessageBoxIcon.Information);
                        OpenLoginForm();
                    }

                    else
                    {
                        MessageBox.Show("Akatsa erabiltzailea sortzean", "Errorea", MessageBoxButtons.OK, MessageBoxIcon.Error);
                    }
                }

            }

            catch (Exception ex)
            {
                MessageBox.Show("Errorea: " + ex.Message, "Errorea", MessageBoxButtons.OK, MessageBoxIcon.Error);
            }

            finally
            {
                conn.Close();
            }
        }

        //Login formularioa ireki
        private void OpenLoginForm()
        {
            Login loginForm = new Login();
            loginForm.Show();
            this.Hide();
        }

        //Login formulario ireki botoiarekin
        private void btnLogin_Click(object sender, EventArgs e)
        {
            OpenLoginForm();
        }
    }
}