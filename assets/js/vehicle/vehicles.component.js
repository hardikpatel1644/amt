// component that contains all the logic and other smaller components
// that form the Read Vehicles view
window.VehiclesComponent = React.createClass({
    getInitialState: function () {
        return {
            vehicles: [],
        };
    },

    // on mount, fetch all vehicles and stored them as this component's state
    componentDidMount: function () {

        this.serverRequest = $.get("http://localhost/amt/API/vehicle", function (vehicles) {
            if (vehicles['error'] == true)
            {
                this.setState({messageCreation: "error"});
            }

            this.setState({
                vehicles: vehicles.data
            });
        }.bind(this));
    },

    // on unmount, kill product fetching in case the request is still pending
    componentWillUnmount: function () {
        this.serverRequest.abort();
    },


    
    // render component on the page
    render: function () {
        // list of vehicles
        var filteredVehicles = this.state.vehicles;
        $('.page-header h1').text('Vehicles');

        return (
                <div>
                    <div className='overflow-hidden'>
                        <TopActionsComponent changeAppMode={this.props.changeAppMode} />
                        <VehiclesTable
                            vehicles={filteredVehicles}
                            changeAppMode={this.props.changeAppMode} 
                           />
                    </div>
                </div>
                            );
                }
    });