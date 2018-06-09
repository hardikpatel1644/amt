// component that contains the logic to read one vehicle
window.ViewVehicleComponent = React.createClass({
    getInitialState: function () {
        // Get this vehicle fields from the data attributes we set on the
        // #content div, using jQuery
        return {
            id: '',
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
            active: ''
        };
    },

// on mount, read vehicle data and them as this component's state
    componentDidMount: function () {

        var id = this.props.id;

        this.serverRequestProd = $.get("http://localhost/amt/API/vehicle/view.php?id=" + id,
                function (vehicle) {
                    vehicle = vehicle.data;
                    this.setState({id: vehicle.id});
                    this.setState({company: vehicle.company});
                    this.setState({model: vehicle.model});
                    this.setState({model_year: vehicle.model_year});
                    this.setState({vehicle_type: vehicle.vehicle_type});
                    this.setState({licence_plate: vehicle.licence_plate});
                    this.setState({color: vehicle.color});
                    this.setState({vin_no: vehicle.vin_no});
                    this.setState({transmission: vehicle.transmission});
                    this.setState({body_type: vehicle.body_type});
                    this.setState({last_odometer: vehicle.last_odometer});
                    this.setState({active: vehicle.active});
                }.bind(this));


        $('.page-header h1').text('View Vehicle');
    },

// on unmount, kill categories fetching in case the request is still pending
    componentWillUnmount: function () {
        this.serverRequestProd.abort();

    },

// render component html will be here
    render: function () {

        return (
                <div>
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
                                    <td>{this.state.company}</td>
                                </tr>
                
                                <tr>
                                    <td>Model</td>
                                    <td>{this.state.model}</td>
                                </tr>
                
                                <tr>
                                    <td>Model year</td>
                                    <td>{this.state.model_year}</td>
                                </tr>
                
                                <tr>
                                    <td>Vehicle type</td>
                                    <td>{this.state.vehicle_type}</td>
                                </tr>
                                <tr>
                                    <td>Licence Plate</td>
                                    <td>{this.state.licence_plate}</td>
                                </tr>
                                <tr>
                                    <td>Color</td>
                                    <td>{this.state.color}</td>
                                </tr>
                                <tr>
                                    <td>VIN no</td>
                                    <td>{this.state.vin_no}</td>
                                </tr>
                                <tr>
                                    <td>Transmission</td>
                                    <td>{this.state.transmission}</td>
                                </tr>
                                <tr>
                                    <td>Body type</td>
                                    <td>{this.state.body_type}</td>
                                </tr>
                                <tr>
                                    <td>Last odometer</td>
                                    <td>{this.state.last_odometer}</td>
                                </tr>
                                <tr>
                                    <td>Active</td>
                                    <td>{this.state.active == "1" ? "Yes" : "No"}</td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
                );
    }
});