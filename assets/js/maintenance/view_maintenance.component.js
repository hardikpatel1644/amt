// component that contains the logic to read one maintenance
window.ViewMaintenanceComponent = React.createClass({
    getInitialState: function () {
        // Get this maintenance fields from the data attributes we set on the
        // #content div, using jQuery
        return {
            id: '',
            maintenance_name: '',
            cost: '',
            description: '',
            active: ''
        };
    },

// on mount, read maintenance data and them as this component's state
    componentDidMount: function () {

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


        $('.page-header h1').text('View Maintenance');
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
                       onClick={() => this.props.changeAppMode('view',this.state.id_vehicle)}
                       className='btn btn-primary margin-bottom-1em'>
                       Back
                    </a>
                
                  
                        <table className='table table-bordered table-hover'>
                            <tbody>
                                <tr>
                                    <td>Maintenance name</td>
                                    <td>{this.state.maintenance_name}</td>
                                </tr>
                
                                <tr>
                                    <td>Cost</td>
                                    <td>{this.state.cost}</td>
                                </tr>
                
                                <tr>
                                    <td>Description</td>
                                    <td>{this.state.description}</td>
                                </tr>
                                <tr>
                                    <td>Active</td>
                                    <td>{this.state.active == "1" ? "Yes" : "No"}</td>
                                </tr>
                            </tbody>
                        </table>
              
                </div>
                );
    }
});