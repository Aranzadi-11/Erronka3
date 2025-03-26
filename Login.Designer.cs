namespace BezeroenAPP
{
    partial class Login
    {
        private System.ComponentModel.IContainer components = null;
        private System.Windows.Forms.Label lblErabiltzaileIzena;
        private System.Windows.Forms.Label lblPasahitza;
        private System.Windows.Forms.TextBox txtErabiltzaileIzena;
        private System.Windows.Forms.TextBox txtPasahitza;
        private System.Windows.Forms.Button btnLogin;
        private System.Windows.Forms.Panel panel1;
        private System.Windows.Forms.Panel panel2;

        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        private void InitializeComponent()
        {
            this.lblErabiltzaileIzena = new System.Windows.Forms.Label();
            this.lblPasahitza = new System.Windows.Forms.Label();
            this.txtErabiltzaileIzena = new System.Windows.Forms.TextBox();
            this.txtPasahitza = new System.Windows.Forms.TextBox();
            this.btnLogin = new System.Windows.Forms.Button();
            this.panel1 = new System.Windows.Forms.Panel();
            this.panel2 = new System.Windows.Forms.Panel();
            this.SuspendLayout();

            //Login formularioaren propietateak
            this.BackColor = System.Drawing.Color.White;
            this.ClientSize = new System.Drawing.Size(350, 450);
            this.FormBorderStyle = System.Windows.Forms.FormBorderStyle.FixedSingle;
            this.StartPosition = System.Windows.Forms.FormStartPosition.CenterScreen;
            this.Text = "Saioa Hasi";

            // lblErabiltzaileIzena
            this.lblErabiltzaileIzena.Text = "Erabiltzaile izena:";
            this.lblErabiltzaileIzena.ForeColor = System.Drawing.Color.Black;
            this.lblErabiltzaileIzena.Font = new System.Drawing.Font("Arial", 10);
            this.lblErabiltzaileIzena.Location = new System.Drawing.Point(40, 100);
            this.lblErabiltzaileIzena.Size = new System.Drawing.Size(145, 20);

            //lblPasahitza
            this.lblPasahitza.Text = "Pasahitza:";
            this.lblPasahitza.ForeColor = System.Drawing.Color.Black;
            this.lblPasahitza.Font = new System.Drawing.Font("Arial", 10);
            this.lblPasahitza.Location = new System.Drawing.Point(40, 170);
            this.lblPasahitza.Size = new System.Drawing.Size(120, 20);

            //txtErabiltzaileIzena
            this.txtErabiltzaileIzena.Location = new System.Drawing.Point(40, 125);
            this.txtErabiltzaileIzena.Size = new System.Drawing.Size(250, 30);
            this.txtErabiltzaileIzena.Font = new System.Drawing.Font("Arial", 12);
            this.txtErabiltzaileIzena.BorderStyle = System.Windows.Forms.BorderStyle.None;

            //Beherako panela (txtErabiltzaileIzena)
            this.panel1.Location = new System.Drawing.Point(40, 155);
            this.panel1.Size = new System.Drawing.Size(250, 2);
            this.panel1.BackColor = System.Drawing.Color.Blue;

            //txtPasahitza
            this.txtPasahitza.Location = new System.Drawing.Point(40, 195);
            this.txtPasahitza.Size = new System.Drawing.Size(250, 30);
            this.txtPasahitza.Font = new System.Drawing.Font("Arial", 12);
            this.txtPasahitza.BorderStyle = System.Windows.Forms.BorderStyle.None;
            this.txtPasahitza.UseSystemPasswordChar = true;

            //Beherako panela (txtPasahitza)
            this.panel2.Location = new System.Drawing.Point(40, 225);
            this.panel2.Size = new System.Drawing.Size(250, 2);
            this.panel2.BackColor = System.Drawing.Color.Blue;

            //btnLogin
            this.btnLogin.Text = "Saioa Hasi";
            this.btnLogin.Location = new System.Drawing.Point(40, 280);
            this.btnLogin.Size = new System.Drawing.Size(250, 40);
            this.btnLogin.BackColor = System.Drawing.Color.Blue;
            this.btnLogin.ForeColor = System.Drawing.Color.White;
            this.btnLogin.FlatStyle = System.Windows.Forms.FlatStyle.Flat;
            this.btnLogin.Font = new System.Drawing.Font("Arial", 12, System.Drawing.FontStyle.Bold);
            this.btnLogin.Click += new System.EventHandler(this.btnLogin_Click);

            //Kontrolak
            this.Controls.Add(this.lblErabiltzaileIzena);
            this.Controls.Add(this.lblPasahitza);
            this.Controls.Add(this.txtErabiltzaileIzena);
            this.Controls.Add(this.txtPasahitza);
            this.Controls.Add(this.panel1);
            this.Controls.Add(this.panel2);
            this.Controls.Add(this.btnLogin);

            this.ResumeLayout(false);
        }
    }
}
