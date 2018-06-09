/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


window.CreateUserComponent = React.createClass({
// initialize values
getInitialState: function() {
return {

first_name: '',
        last_name: '',
        email: '',
        password: '',
        user_type: '',
          active: '',
        messageCreation: null,
        message: null
};
},
// on mount, get all categories and store them in this component's state
        componentDidMount: function() {
       
                $('.page-header h1').text('Add new');
        },

        componentWillUnmount: function() {
        this.serverRequest.abort();
        },

        onFirstnameChange: function(e) {
        this.setState({first_name: e.target.value});
        },

        onLastnameChange: function(e) {
        this.setState({last_name: e.target.value});
        },

        onEmailChange: function(e) {
        this.setState({email: e.target.value});
        },

        onPasswordChange: function(e) {
        this.setState({password: e.target.value});
        },

        onUsertypeChange: function(e) {
        this.setState({user_type: e.target.value});
        },
        
       onActiveChange: function(e) {
        this.setState({active: e.target.value});
        },
// handle save button here

// handle save button clicked
        onSave: function(e){

        // data in the form
        var form_data = {
        first_name: this.state.first_name,
                last_name: this.state.last_name,
                email: this.state.email,
                password: this.state.password,
                user_type: this.state.user_type,
                active: this.state.active,
        };
                // submit form data to api
                $.ajax({
                url: "http://localhost/amt/API/user/create.php",
                        type : "POST",
                        //contentType : 'application/json',
                        data : form_data,
                        success : function(response) {

                        if(response['error'] == true)
                        {
                            this.setState({messageCreation: "error"});
                        }
                        if(response['success'] == true)
                        {
                            this.setState({messageCreation: "success"});
                            // empty form
                                this.setState({first_name: ""});
                                this.setState({last_name: ""});
                                this.setState({email: ""});
                                this.setState({password: ""});
                                this.setState({user_type: ""});
                                this.setState({active: ""});
                        }
                        
                        // api message
                        this.setState({message: response['message']});
                                
                        }.bind(this),
                        error: function(xhr, response, text){
                        // show error to console
                                console.log(xhr, resp, text);
                        }
                });
                e.preventDefault();
                },
// render component here
        render: function() {

        /*
         - tell the user if a user was created
         - tell the user if unable to create user
         - button to go back to users list
         - form to create a user
         */
        return (
<div>
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

    <a href='#'
       onClick={() => this.props.changeAppMode('read')}
       className='btn btn-primary margin-bottom-1em'> Users
    </a>


    <form onSubmit={this.onSave}>
        <table className='table table-bordered table-hover'>
            <tbody>
                <tr>
                    <td>Firstname</td>
                    <td>
                        <input
                            type='text'
                            className='form-control'
                            value={this.state.first_name}
                            required
                            onChange={this.onFirstnameChange} />
                    </td>
                </tr>

                <tr>
                    <td>Lastname</td>
                    <td>
                        <input
                            type='text'
                            className='form-control'
                            value={this.state.last_name}
                            required
                            onChange={this.onLastnameChange} />
                    </td>
                </tr>

                <tr>
                    <td>Email</td>
                    <td>
                        <input
                            type='email'
                            className='form-control'
                            value={this.state.email}
                            required
                            onChange={this.onEmailChange}/>
                    </td>
                </tr>

                <tr>
                    <td>Password</td>
                    <td>
                        <input
                            type='password'
                            className='form-control'
                            value={this.state.password}
                            required
                            onChange={this.onPasswordChange}/>
                    </td>
                </tr>

                <tr>
                    <td>User type</td>
                    <td>
                        <select
                           
                            className='form-control'
                            value={this.state.user_type}
                             onChange={this.onUsertypeChange}
                            required
                            >
                            <option value="">Select User type...</option>
                            <option value="admin">Admin</option>
                            <option value="customer">Customer</option>
                        </select>
                    </td>
                </tr>
             <tr>
                    <td>Active</td>
                    <td>
                        <select
                            onChange={this.onActiveChange}
                            className='form-control'
                             value={this.state.active}
                            required
                            >
                            <option value="">Select Status...</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <button
                            className='btn btn-primary'
                            onClick={this.onSave}>Save</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</div>
                );
                }
});