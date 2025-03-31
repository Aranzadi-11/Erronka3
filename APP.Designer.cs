using System.Windows.Forms;

namespace BezeroenAPP
{
    partial class APP
    {
        private System.ComponentModel.IContainer components = null;
        private Label lblTitle;
        private Panel panelHeader;
        private Panel panelAccent;
        private Panel panelReservas;

        private void InitializeComponent()
        {
            this.lblTitle = new System.Windows.Forms.Label();
            this.panelHeader = new System.Windows.Forms.Panel();
            this.panelAccent = new System.Windows.Forms.Panel();
            this.panelReservas = new System.Windows.Forms.Panel();
            this.SuspendLayout();

            //Formularioa
            this.BackColor = System.Drawing.Color.White;
            this.ClientSize = new System.Drawing.Size(800, 450);
            this.StartPosition = System.Windows.Forms.FormStartPosition.CenterScreen;
            this.Name = "APP";
            this.Text = "BezeroenAPP";

            //Header
            this.panelHeader.BackColor = System.Drawing.Color.Blue;
            this.panelHeader.Dock = System.Windows.Forms.DockStyle.Top;
            this.panelHeader.Height = 60;
            this.panelHeader.Controls.Add(this.lblTitle);

            //Tituloa
            this.lblTitle.Text = "Kaixo, ";
            this.lblTitle.ForeColor = System.Drawing.Color.White;
            this.lblTitle.Font = new System.Drawing.Font("Arial", 18F, System.Drawing.FontStyle.Bold);
            this.lblTitle.Dock = System.Windows.Forms.DockStyle.Fill;
            this.lblTitle.TextAlign = System.Drawing.ContentAlignment.MiddleCenter;

            //Erreserbak panela
            this.panelReservas.Dock = System.Windows.Forms.DockStyle.Fill;
            this.panelReservas.AutoScroll = true;
            this.panelReservas.BackColor = System.Drawing.Color.White;
            this.panelReservas.Location = new System.Drawing.Point(0, 60);
            this.panelReservas.Name = "panelReservas";
            this.panelReservas.Size = new System.Drawing.Size(840, 390);
            this.panelReservas.TabIndex = 1;

            //Kontrolak formularioan gehitu
            this.Controls.Add(this.panelReservas);
            this.Controls.Add(this.panelHeader);
            this.ResumeLayout(false);
        }

    }
}