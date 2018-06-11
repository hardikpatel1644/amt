// component that contains all the logic and other smaller components
// that form the Read Maintenances view
window.MaintenancesComponent = React.createClass({
    getInitialState: function () {
        return {
            maintenances: [],
        };
    },

    // on mount, fetch all maintenances and stored them as this component's state
    componentDidMount: function () {
        this.serverRequest = $.get("http://localhost/amt/API/maintenance", function (maintenances) {
            if (maintenances['error'] == true)
            {
                this.setState({messageCreation: "error"});
            }
            this.setState({
                maintenances: maintenances.data
            });
        }.bind(this));
    },

    // on unmount, kill product fetching in case the request is still pending
    componentWillUnmount: function () {
        this.serverRequest.abort();
    },

    // render component on the page
    render: function () {
        // list of maintenances
        var filteredMaintenances = this.state.maintenances;
        $('.page-header h1').text('Maintenances');

        return (
                <div>
                    <div className='overflow-hidden'>
                    <a href='#'
                        onClick={() => this.props.changeAppMode('create')}
                        className='btn btn-primary margin-bottom-1em'> Add new
                     </a>
                        <MaintenancesTable
                            maintenances={filteredMaintenances}
                            changeAppMode={this.props.changeAppMode} />
                    </div>
                </div>
                            );
                }
    });