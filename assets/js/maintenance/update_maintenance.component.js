// component that contains the logic to update a maintenance
window.UpdateMaintenanceComponent = React.createClass({
    // initial component states will be here
    getInitialState: function() {
    // Get this maintenance fields from the data attributes we set on the
    // #content div, using jQuery
    return {
        id_vehicle: '',
        maintenance_name: '',
        cost: '',
        description: '',
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
                     this.setState({id_vehicle: maintenance.id_vehicle});
                    this.setState({maintenance_name: maintenance.maintenance_name});
                    this.setState({cost: maintenance.cost});
                    this.setState({description: maintenance.description});
                    this.setState({active: maintenance.active});
        }.bind(this));
 
    $('.page-header h1').text('Update maintenance');
},
 

componentWillUnmount: function() {
    this.serverRequestProd.abort();
},
  onId_vechilceChange: function(e) {
        this.setState({id_vehicle: e.target.value});
        },

        onMaintenance_nameChange: function(e) {
        this.setState({maintenance_name: e.target.value});
        },

        onCostChange: function(e) {
        this.setState({cost: e.target.value});
        },

        onDescriptionChange: function(e) {
        this.setState({description: e.target.value});
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
                maintenance_name: this.state.maintenance_name,
                cost: this.state.cost,
                description: this.state.description,
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
        this.state.messageCreation == "success" ?<div className='alert alert-success' dangerouslySetInnerHTML={{__html: this.state.message}}></div>: null
    }
    {
        this.state.messageCreation == "error" ?<div className='alert alert-danger' dangerouslySetInnerHTML={{__html: this.state.message}}></div>: null
    }

    <a href='#'
       onClick={() => this.props.changeAppMode('view',this.state.id_vehicle)}
       className='btn btn-primary margin-bottom-1em'> Back
    </a>

    <form onSubmit={this.onSave}>
        <table className='table table-bordered table-hover'>
            <tbody>
         
                <tr>
                    <td>Maintenance name</td>
                    <td>
                      
                        <select
                            onChange={this.onMaintenance_nameChange}
                            className='form-control'
                            value={this.state.maintenance_name}
                            required
                            >
                            <option value="">Select Maintenance...</option>
                            <option value="oil_change">Oil chnage</option>
                            <option value="tire_rotation">Tire rotation</option>
                            <option value="summer_tires">Summer tires</option>
                            <option value="winter_tires">Winter tires</option>
                            <option value="repair_and_maintenance">Repair and maintenance</option>
                            <option value="car_washing">Car washing</option>
                            <option value="wheel_alignment">Wheel alignment</option>
                            <option value="break_inspection">Break inspection</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Cost</td>
                    <td>
                        <input
                            type='text'
                            className='form-control'
                            value={this.state.cost}
                            required
                            onChange={this.onCostChange} />
                    </td>
                </tr>

                <tr>
                    <td>Description</td>
                    <td>
                        <input
                            type='text'
                            className='form-control'
                            value={this.state.description}
                            required
                            onChange={this.onDescriptionChange}/>
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