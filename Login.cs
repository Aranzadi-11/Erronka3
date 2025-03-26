using System;
using System.Data.SqlClient;
using System.Windows.Forms;
using BezeroenAPP;

namespace BezeroenAPP
{
    public partial class Login : Form
    {
        public Login()
        {
            InitializeComponent();
        }

        private void btnLogin_Click(object sender, EventArgs e)
        {
            string erabiltzaileIzena = txtErabiltzaileIzena.Text;
            string pasahitza = txtPasahitza.Text;

            using (SqlConnection conn = DBKonexioa.LortuKonexioa())
            {
                try
                {
                    conn.Open();
                    string query = "SELECT COUNT(*) FROM bezeroak WHERE erabiltzaileIzena=@izena AND pasahitza=@pasahitza";
                    using (SqlCommand cmd = new SqlCommand(query, conn))
                    {
                        cmd.Parameters.AddWithValue("@izena", erabiltzaileIzena);
                        cmd.Parameters.AddWithValue("@pasahitza", pasahitza);
                        int count = (int)cmd.ExecuteScalar();

                        if (count > 0)
                        {
                            MessageBox.Show("Ongi etorri!", "Arrakasta", MessageBoxButtons.OK, MessageBoxIcon.Information);
                            this.Hide();
                            APP nagusia = new APP();
                            nagusia.Show();
                        }
                        else
                        {
                            MessageBox.Show("Erabiltzaile izena edo pasahitza okerra!", "Errorea", MessageBoxButtons.OK, MessageBoxIcon.Error);
                        }
                    }
                }
                catch (Exception ex)
                {
                    MessageBox.Show("Errorea: " + ex.Message, "Errorea", MessageBoxButtons.OK, MessageBoxIcon.Error);
                }
            }
        }
    }
}
