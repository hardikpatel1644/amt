// component that contains the logic to update a maintenance
window.UpdateMaintenanceComponent = React.createClass({
    // initial component states will be here
    getInitialState: function() {
    // Get this maintenance fields from the data attributes we set on the
    // #content div, using jQuery
    return {
        first_name: '',
        last_name: '',
        email: '',
        password: '',
        maintenance_type: '',
        active: '',
        messageCreation: null,
        message: null,
        successUpdate: null
    };
},
 

componentDidMount: function(){
 
    // read one maintenance data
    var id = this.props.id;
    this.serverRequestProd = $.get("http://localhost/amt/API/maintenance/view.php?id=" + id,
        function (maintenance) {
            maintenance = maintenance.data;
            this.setState({id: maintenance.id});
            this.setState({first_name: maintenance.first_name});
            this.setState({last_name: maintenance.last_name});
            this.setState({email: maintenance.email});
            this.setState({password: ''});
            this.setState({maintenance_type: maintenance.maintenance_type});
            this.setState({active: maintenance.active});
        }.bind(this));
 
    $('.page-header h1').text('Update maintenance');
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

        onMaintenancetypeChange: function(e) {
        this.setState({maintenance_type: e.target.value});
        },
        
        onActiveChange: function(e) {
        this.setState({active: e.target.value});
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
        maintenance_type: this.state.maintenance_type,
        active: this.state.active,
    };
 
    // submit form data to api
    $.ajax({
        url: "http://localhost/amt/API/maintenance/update.php",
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
                Maintenances
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
                    <td>Maintenance type</td>
                    <td>
                        <select
                            onChange={this.onMaintenancetypeChange}
                            className='form-control'
                            value={this.state.maintenance_type}
                            required
                            >
                            <option value="">Select Maintenance type...</option>
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