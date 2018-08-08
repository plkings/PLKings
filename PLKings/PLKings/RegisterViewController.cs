using Foundation;
using System;
using UIKit;
using System.Net.Http;
using System.Text;

namespace PLKings
{
    public partial class RegisterViewController : UIViewController
    {
        public RegisterViewController (IntPtr handle) : base (handle)
        {
            
        }

        public override void ViewDidLoad()
        {
            base.ViewDidLoad();
            // Perform any additional setup after loading the view, typically from a nib.

            registerButton.TouchUpInside += (object sender, EventArgs e) =>
            {
                //Grab text values
                string sUserName = userNameTextField.Text;
                string sFullName = nameTextField.Text;
                string sEmailAddress = emailTextField.Text;
                string sPassword = passwordTextField.Text;
                string sConfirmPassword = confirmPasswordTextFIeld.Text;

                //Create the HTTP Request
                var client = new HttpClient();
                client.BaseAddress = new Uri("localhost:8080");

                //string sJsonData = @"{""usernmae"": ""sUserName"", ""password"" : ""sPassword"", ""email"" : ""sEmailAddress"", ""name"" : ""sFullName""}";
                string sJsonData = @"{""username"":""Hello""}";

                var content = new StringContent(sJsonData, Encoding.UTF8, "apllication/json");
                //HttpResponseMessage hrmResponse = await client.PostAsync("/PLKings/V1/register.php", content);


            };
        }
    }
}