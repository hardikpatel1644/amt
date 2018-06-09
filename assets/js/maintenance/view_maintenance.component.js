// component that contains the logic to read one maintenance
window.ViewMaintenanceComponent = React.createClass({
    getInitialState: function () {
        // Get this maintenance fields from the data attributes we set on the
        // #content div, using jQuery
        return {
            id: '',
            first_name: '',
            last_name: '',
            email: '',
            maintenance_type: '',
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
                    this.setState({first_name: maintenance.first_name});
                    this.setState({last_name: maintenance.last_name});
                    this.setState({email: maintenance.email});
                    this.setState({password: ''});
                    this.setState({maintenance_type: maintenance.maintenance_type});
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
                       onClick={() => this.props.changeAppMode('read')}
                       className='btn btn-primary margin-bottom-1em'>
                        Maintenances
                    </a>
                
                    <form onSubmit={this.onSave}>
                        <table className='table table-bordered table-hover'>
                            <tbody>
                                <tr>
                                    <td>Firstname</td>
                                    <td>{this.state.first_name}</td>
                                </tr>
                
                                <tr>
                                    <td>Lastname</td>
                                    <td>{this.state.last_name}</td>
                                </tr>
                
                                <tr>
                                    <td>Email</td>
                                    <td>{this.state.email}</td>
                                </tr>
                
                                <tr>
                                    <td>Maintenance type</td>
                                    <td>{this.state.maintenance_type}</td>
                                </tr>
                                <tr>
                                    <td>Maintenance type</td>
                                    <td>{this.state.active == "1" ? "Yes" : "No"}</td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
                );
    }
});