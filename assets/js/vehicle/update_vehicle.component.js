// component that contains the logic to update a vehicle
window.UpdateVehicleComponent = React.createClass({
    // initial component states will be here
    getInitialState: function() {
    // Get this vehicle fields from the data attributes we set on the
    // #content div, using jQuery
    return {
        company: '',
        model: '',
        model_year: '',
        vehicle_type: '',
        licence_plate: '',
        color: '',
        vin_no: '',
        transmission: '',
        body_type: '',
        last_odometer: '',
        messageCreation: null,
        message: null,
        successUpdate: null
    };
},
 

componentDidMount: function(){
 
    // read one vehicle data
    var id = this.props.id;
    this.serverRequestProd = $.get("http://localhost/amt/API/vehicle/view.php?id=" + id,
        function (vehicle) {
            vehicle = vehicle.data;
            this.setState({id: vehicle.id});
            this.setState({company: vehicle.company});
            this.setState({model: vehicle.model});
            this.setState({model_year: vehicle.model_year});
            this.setState({vehicle_type:  vehicle.vehicle_type});
            this.setState({licence_plate: vehicle.licence_plate});
            this.setState({color: vehicle.color});
            this.setState({vin_no: vehicle.vin_no});
            this.setState({transmission: vehicle.transmission});
            this.setState({body_type: vehicle.body_type});
            this.setState({last_odometer: vehicle.last_odometer});
            this.setState({active: vehicle.active});
        }.bind(this));
 
    $('.page-header h1').text('Update vehicle');
},
 

componentWillUnmount: function() {
    this.serverRequestProd.abort();
},
   onCompanyChange: function(e) {
        this.setState({company: e.target.value});
        },

        onModelChange: function(e) {
        this.setState({model: e.target.value});
        },
        
        onModelyearChange: function(e) {
        this.setState({model_year: e.target.value});
        },

        onVehicletypeChange: function(e) {
        this.setState({vehicle_type: e.target.value});
        },
        onLicenceplateChange: function(e) {
        this.setState({licence_plate: e.target.value});
        },
        onColorChange: function(e) {
        this.setState({color: e.target.value});
        },
        onVinnoChange: function(e) {
        this.setState({vin_no: e.target.value});
        },
        onTransmissionChange: function(e) {
        this.setState({transmission: e.target.value});
        },
        onBodytypeChange: function(e) {
        this.setState({body_type: e.target.value});
        },
        onLastodometerChange: function(e) {
        this.setState({last_odometer: e.target.value});
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
        company: this.state.company,
                model: this.state.model,
                model_year: this.state.model_year,
                vehicle_type: this.state.vehicle_type,
                licence_plate: this.state.licence_plate,
                color: this.state.color,
                vin_no: this.state.vin_no,
                transmission: this.state.transmission,
                last_odometer: this.state.last_odometer,
                body_type: this.state.body_type,
                  active: this.state.active,
    };
 
    // submit form data to api
    $.ajax({
        url: "http://localhost/amt/API/vehicle/update.php",
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
                Vehicles
            </a>
 
           <form onSubmit={this.onSave}>
        <table className='table table-bordered table-hover'>
            <tbody>
                <tr>
                    <td>Company</td>
                    <td>
                        <input
                            type='text'
                            className='form-control'
                          value={this.state.company}
                            required
                            onChange={this.onCompanyChange}
                             />
                    </td>
                </tr>

                <tr>
                    <td>Model</td>
                    <td>
                        <input
                            type='text'
                            className='form-control'
                             value={this.state.model}
                             onChange={this.onModelChange}
                            required
                             />
                    </td>
                </tr>

                <tr>
                    <td>Model year</td>
                    <td>
                        <input
                            type='number'
                            className='form-control'
                             value={this.state.model_year}
                            onChange={this.onModelyearChange}                           
                            required
                            />
                    </td>
                </tr>

                <tr>
                    <td>Vehicle type</td>
                    <td>
                    
                    <select
                            className='form-control'
                            required
                             value={this.state.vehicle_type}
                             onChange={this.onVehicletypeChange}
                            >
                            <option value="">Select Vehicle type...</option>
                            <option value="electric">Electric</option>
                            <option value="gas">Gas</option>
                            <option value="diesel">Diesel</option>
                        </select>
                       
                    </td>
                </tr>

                <tr>
                    <td>Licence plate</td>
                    <td>
                            <input
                            type='text'
                            className='form-control'
                            required
                             value={this.state.licence_plate}
                             onChange={this.onLicenceplateChange}
                            />
                    </td>
                </tr>
                <tr>
                    <td>Color</td>
                    <td>
                            <input
                            type='text'
                            className='form-control'
                            required
                             value={this.state.color}
                              onChange={this.onColorChange}
                            />
                    </td>
                </tr>
                <tr>
                    <td>VIN no</td>
                    <td>
                            <input
                            type='text'
                            className='form-control'
                             required
                              value={this.state.vin_no}
                              onChange={this.onVinnoChange}
                            />
                    </td>
                </tr>
                <tr>
                    <td>Transmission</td>
                    <td>
                    
                    <select
                            className='form-control'
                            required
                             value={this.state.transmission}
                              onChange={this.onTransmissionChange}
                            >
                            <option value=''>Select Transmission type...</option>
                            <option value="automatic">Automatic</option>
                            <option value="manual">Manual</option>
                           
                        </select>
                            
                    </td>
                </tr>
                <tr>
                    <td>Body Type</td>
                    <td>
                    <select                            
                            className='form-control'
                           required
                            value={this.state.body_type}
                              onChange={this.onBodytypeChange}
                            >
                            <option value=''>Select Body type...</option>
                            <option value="suv">Suv</option>
                            <option value="sedan">Sedan</option>
                            <option value="van">Van</option>
                            <option value="truck">Truck</option>
                            <option value="hatchback">Hatchback</option>
                           
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Last Odometer</td>
                    <td>
                            <input
                            type='text'
                            className='form-control'
                            required
                             value={this.state.last_odometer}
                              onChange={this.onLastodometerChange}
                            />
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