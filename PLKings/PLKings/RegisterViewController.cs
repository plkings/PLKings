using Foundation;
using System;
using UIKit;
using System.Net;
using System.Net.Http;
using System.Text;
using RestSharp;
using RestSharp.Authenticators;
using System.Collections;
using Newtonsoft.Json;

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

                //Check if passwords match

                //Create the HTTP Request
                var client = new RestClient();
                client.BaseUrl = new Uri("http://localhost:8080/PLKings/V1/register.php");

                var request = new RestRequest(Method.POST);
                request.AddParameter("username", sUserName);
                request.AddParameter("password", sPassword);
                request.AddParameter("email", sEmailAddress);
                request.AddParameter("name", sFullName);

                IRestResponse response = client.Execute(request);

                if(response != null)
                {
                    if(response.StatusCode == HttpStatusCode.OK)
                    {
                        //Read the "Error" and "Message"
                        //var content = response.Content;
                        var JsonObject = response.Content;

                        //False: User created succefully

                        //True:Ethier use already created or some other error
                        
                    }

                }

                //Find way to give status


            };
        }
    }
}