/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


window.LoginComponent = React.createClass({
// initialize values
    getInitialState: function () {
        return {
            email: '',
            password: '',
            messageCreation: null,
            message: null,
            TOKEN:''
        };
    },
    componentDidMount: function () {
        $('.page-header h1').text('Login');
    },

    componentWillUnmount: function () {
        this.serverRequest.abort();
    },

    onEmailChange: function (e) {
        this.setState({email: e.target.value});
    },

    onPasswordChange: function (e) {
        this.setState({password: e.target.value});
    },

// handle save button clicked
    onSave: function (e) {

        // data in the form
        var form_data = {
            email: this.state.email,
            password: this.state.password,

        };
        // submit form data to api
        $.ajax({
            url: "http://localhost/amt/API/user/login.php",
            type: "POST",
            //contentType : 'application/json',
            data: form_data,
            success: function (response) {

                if (response['error'] == true)
                {
                    this.setState({messageCreation: "error"});
                }
                if (response['success'] == true)
                {
                    
                
                 
                    $.ajax({
                        url: "http://localhost/amt/dashboard.html",
                        type: "GET",
                        success: function (dashboard) {
                        $("#content").html(dashboard);
                        $('.page-header h1').text('Dashboard');
                        }.bind(this),
                            error: function (xhr, response, text) {
                        }
                    });
                    
                      
                    this.setState({messageCreation: "success"});
                }

                // api message
                this.setState({message: response['message']});
                 this.setState({TOKEN: response['TOKEN']});
                // empty form
                this.setState({email: ""});
                this.setState({password: ""});
            }.bind(this),
            error: function (xhr, response, text) {
                // show error to console
                console.log(xhr, resp, text);
            }
        });
        e.preventDefault();
},
// render component here
render: function () {


    return (
            
<div class="col-md-6">
    {

            this.state.messageCreation == "success" ?
    <div className='alert alert-success' dangerouslySetInnerHTML={{__html: this.state.message}}></div>
                    : null
    }

    {

                    this.state.messageCreation == "error" ?
    <div className='alert alert-danger' dangerouslySetInnerHTML={{__html: this.state.message}}></div>
                            : null
    }

{
this.state.message == "Login successfully." ?<div id='content'>Test</div> :null
}

    <form onSubmit={this.onSave}>

        <label for='email'><b>Email</b></label>
        <input
            type='email'
            className='form-control'
            value={
                    this.state.email}
            required
            onChange={
                    this.onEmailChange}/>
                    
                     <br/>
        <label for='email'><b>Password</b></label>
            
                <input
                    type='password'
                    className='form-control'
                    value={this.state.password}
                    required
                    onChange={this.onPasswordChange}/>
      
                    <br/>
       
                <button
                    className='btn btn-primary col-md-12'
                    onClick={this.onSave}>Login</button>

    </form>
</div>
                );
                }
});

ReactDOM.render(
< LoginComponent / > ,
document.getElementById('content')
);