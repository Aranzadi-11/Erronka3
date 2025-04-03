namespace BezeroenAPP
{
    partial class ErreserbaEditatu
    {
        private System.ComponentModel.IContainer components = null;
        private System.Windows.Forms.Label lblSarreraOrdua;
        private System.Windows.Forms.Label lblIrteeraOrdua;
        private System.Windows.Forms.DateTimePicker dtpSarreraOrdua;
        private System.Windows.Forms.DateTimePicker dtpIrteeraOrdua;
        private System.Windows.Forms.Button btnGorde;
        private System.Windows.Forms.Label lblIruzkina;
        private System.Windows.Forms.TextBox txtIruzkina;

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
            this.lblSarreraOrdua = new System.Windows.Forms.Label();
            this.lblIrteeraOrdua = new System.Windows.Forms.Label();
            this.dtpSarreraOrdua = new System.Windows.Forms.DateTimePicker();
            this.dtpIrteeraOrdua = new System.Windows.Forms.DateTimePicker();
            this.btnGorde = new System.Windows.Forms.Button();
            this.lblIruzkina = new System.Windows.Forms.Label();
            this.txtIruzkina = new System.Windows.Forms.TextBox();
            this.SuspendLayout();

            // lblSarreraOrdua
            this.lblSarreraOrdua.AutoSize = true;
            this.lblSarreraOrdua.Location = new System.Drawing.Point(20, 20);
            this.lblSarreraOrdua.Name = "lblSarreraOrdua";
            this.lblSarreraOrdua.Size = new System.Drawing.Size(90, 13);
            this.lblSarreraOrdua.Text = "Sarrera Ordua:";

            // dtpSarreraOrdua
            this.dtpSarreraOrdua.Format = System.Windows.Forms.DateTimePickerFormat.Custom;
            this.dtpSarreraOrdua.CustomFormat = "HH:mm";
            this.dtpSarreraOrdua.ShowUpDown = true;
            this.dtpSarreraOrdua.Location = new System.Drawing.Point(140, 20);
            this.dtpSarreraOrdua.Name = "dtpSarreraOrdua";
            this.dtpSarreraOrdua.Size = new System.Drawing.Size(120, 20);

            // lblIrteeraOrdua
            this.lblIrteeraOrdua.AutoSize = true;
            this.lblIrteeraOrdua.Location = new System.Drawing.Point(20, 60);
            this.lblIrteeraOrdua.Name = "lblIrteeraOrdua";
            this.lblIrteeraOrdua.Size = new System.Drawing.Size(90, 13);
            this.lblIrteeraOrdua.Text = "Irteera Ordua:";

            // dtpIrteeraOrdua
            this.dtpIrteeraOrdua.Format = System.Windows.Forms.DateTimePickerFormat.Custom;
            this.dtpIrteeraOrdua.CustomFormat = "HH:mm";
            this.dtpIrteeraOrdua.ShowUpDown = true;
            this.dtpIrteeraOrdua.Location = new System.Drawing.Point(140, 60);
            this.dtpIrteeraOrdua.Name = "dtpIrteeraOrdua";
            this.dtpIrteeraOrdua.Size = new System.Drawing.Size(120, 20);

            // lblIruzkina
            this.lblIruzkina.AutoSize = true;
            this.lblIruzkina.Location = new System.Drawing.Point(20, 100);
            this.lblIruzkina.Name = "lblIruzkina";
            this.lblIruzkina.Size = new System.Drawing.Size(54, 13);
            this.lblIruzkina.Text = "Iruzkina:";
            this.lblIruzkina.Visible = false;

            // txtIruzkina
            this.txtIruzkina.Location = new System.Drawing.Point(140, 100);
            this.txtIruzkina.Multiline = true;
            this.txtIruzkina.Name = "txtIruzkina";
            this.txtIruzkina.Size = new System.Drawing.Size(200, 60);
            this.txtIruzkina.MaxLength = 255;
            this.txtIruzkina.Visible = false;
            this.txtIruzkina.TextChanged += new System.EventHandler(this.TxtIruzkina_TextChanged);
            this.txtIruzkina.Leave += new System.EventHandler(this.TxtIruzkina_Leave);

            // btnGorde
            this.btnGorde.BackColor = System.Drawing.Color.Blue;
            this.btnGorde.ForeColor = System.Drawing.Color.White;
            this.btnGorde.Location = new System.Drawing.Point(140, 180);
            this.btnGorde.Name = "btnGorde";
            this.btnGorde.Size = new System.Drawing.Size(80, 30);
            this.btnGorde.Text = "Gorde";
            this.btnGorde.UseVisualStyleBackColor = false;
            this.btnGorde.Click += new System.EventHandler(this.BtnGorde_Click);

            // ErreserbaEditatu Form
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(400, 250);
            this.Controls.Add(this.lblSarreraOrdua);
            this.Controls.Add(this.dtpSarreraOrdua);
            this.Controls.Add(this.lblIrteeraOrdua);
            this.Controls.Add(this.dtpIrteeraOrdua);
            this.Controls.Add(this.lblIruzkina);
            this.Controls.Add(this.txtIruzkina);
            this.Controls.Add(this.btnGorde);
            this.FormBorderStyle = System.Windows.Forms.FormBorderStyle.FixedDialog;
            this.MaximizeBox = false;
            this.MinimizeBox = false;
            this.StartPosition = System.Windows.Forms.FormStartPosition.CenterScreen;
            this.Text = "Erreserba Editatu";
            this.ResumeLayout(false);
            this.PerformLayout();
        }
    }
}