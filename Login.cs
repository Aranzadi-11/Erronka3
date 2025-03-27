using System;
using MySql.Data.MySqlClient;
using System.Windows.Forms;
using BezeroenAPP;

namespace BezeroenAPP
{
    public partial class Login : Form
    {
        private int saiakeraKopurua = 0; //Saiakera kontagailua

        public Login()
        {
            InitializeComponent();
        }

        private void btnLogin_Click(object sender, EventArgs e)
        {
            string erabiltzaileIzena = txtErabiltzaileIzena.Text;
            string pasahitza = txtPasahitza.Text;

            // DBKonexioa klasea erabiliz konexioa lortu
            DBKonexioa db = new DBKonexioa();

            try
            {
                //Konexioa ireki
                MySqlConnection conn = db.GetConnection();
                db.OpenConnection(conn);

                string query = "SELECT COUNT(*) FROM bezeroak WHERE erabiltzaileIzena=@izena AND pasahitza=@pasahitza";
                using (MySqlCommand cmd = new MySqlCommand(query, conn))
                {
                    cmd.Parameters.AddWithValue("@izena", erabiltzaileIzena);
                    cmd.Parameters.AddWithValue("@pasahitza", pasahitza);

                    int count = Convert.ToInt32(cmd.ExecuteScalar());

                    //Erabiltzailea existitzen dela ziurtatu
                    if (count > 0)
                    {
                        MessageBox.Show("Ongi etorri!", "Arrakasta", MessageBoxButtons.OK, MessageBoxIcon.Information);

                        //APP formularioa ireki
                        APP nagusia = new APP();
                        nagusia.Show();
                        this.Hide(); //Login formularioa ezkutatu
                    }
                    else
                    {
                        //Saiakera kopurua gehitu
                        saiakeraKopurua++;

                        if (saiakeraKopurua >= 3)
                        {
                            //Hiru saiakera baino gehiago egin badira, errorea erakutsi eta aplikazioa itxi
                            MessageBox.Show("Saikera kopurua agortu duzu, aplikazioa itxi egingo da", "Akatsa", MessageBoxButtons.OK, MessageBoxIcon.Error);
                            Application.Exit(); //Aplikazioa itxi
                        }
                        else
                        {
                            //Erabiltzaile izena edo pasahitza gaizki jarri dutenak
                            MessageBox.Show($"Erabiltzaile izena edo pasahitza gaizki jarri dituzu. Saiakera kopurua: {saiakeraKopurua}/3", "Errorea", MessageBoxButtons.OK, MessageBoxIcon.Error);
                        }
                    }
                }
            }
            catch (Exception ex)
            {
                //Akatsaren mezua erakutsi
                MessageBox.Show("Akatsa: " + ex.Message, "Akatsa", MessageBoxButtons.OK, MessageBoxIcon.Error);
            }
        }

        //Botonari klik egiterakoan, Erregistratu formularioa irekiko da
        private void btnErregistratu_Click(object sender, EventArgs e)
        {
            Erregistratu erregistratuForm = new Erregistratu();
            erregistratuForm.Show();
            this.Hide(); //Login formularioa ezkutatu
        }
    }
}