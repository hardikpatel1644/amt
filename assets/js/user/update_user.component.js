// component that contains the logic to update a user
window.UpdateUserComponent = React.createClass({
    // initial component states will be here
    getInitialState: function() {
    // Get this user fields from the data attributes we set on the
    // #content div, using jQuery
    return {
        first_name: '',
        last_name: '',
        email: '',
        password: '',
        user_type: '',
        messageCreation: null,
        message: null,
        successUpdate: null
    };
},
 

componentDidMount: function(){
 
    // read one user data
    var id = this.props.id;
    this.serverRequestProd = $.get("http://localhost/amt/API/user/view.php?id=" + id,
        function (user) {
            user = user.data;
            this.setState({id: user.id});
            this.setState({first_name: user.first_name});
            this.setState({last_name: user.last_name});
            this.setState({email: user.email});
            this.setState({password: ''});
            this.setState({user_type: user.user_type});
        }.bind(this));
 
    $('.page-header h1').text('Update user');
},
 

componentWillUnmount: function() {
    this.serverRequestProd.abort();
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
 
// handle save changes button here
// handle save changes button clicked
onSave: function(e){
 
    // data in the form
    var form_data={
        id: this.state.id,
        first_name: this.state.first_name,
        last_name: this.state.last_name,
        email: this.state.email,
        password: this.state.password,
        user_type: this.state.user_type,
    };
 
    // submit form data to api
    $.ajax({
        url: "http://localhost/amt/API/user/update.php",
        type : "PUT",
       // contentType : 'application/json',
        data : form_data,
        success : function(response) {
            
            if(response['error'] == true)
                        {
                            this.setState({messageCreation: "error"});
                        }
                        if(response['success'] == true)
                        {
                            this.setState({messageCreation: "success"});
                        }
                            this.setState({message: response['message']});
            
        }.bind(this),
        error: function(xhr, resp, text){
            // show error to console
            console.log(xhr, resp, text);
        }
    });
 
    e.preventDefault();
},
 
// render component here
render: function() {
    
 
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
                className='btn btn-primary margin-bottom-1em'>
                Users
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
                            onChange={this.onUsertypeChange}
                            className='form-control'
                            value=""
                            required
                            >
                            <option value="">Select User type...</option>
                            <option value="admin">Admin</option>
                            <option value="customer">Customer</option>
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