// component for the whole vehicles table
window.VehiclesTable = React.createClass({
    render: function () {

        var rows = this.props.vehicles
                .map(function (vehicle, i) {
                    return (
                            <VehicleRow
                                key={i}
                                vehicle={vehicle}
                                changeAppMode={this.props.changeAppMode} 
                                />
                            );
                }.bind(this));

        return(
                !rows.length
                ? <div className='alert alert-danger'>No records found.</div>
                :
                <table className='table table-bordered table-hover'>
                    <thead>
                        <tr>
                            <th>Company</th>
                            <th>Model</th>
                            <th>Model Year</th>
                            <th>Vehicle Type</th>
                            <th>Active</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {rows}
                    </tbody>
                </table>
                );
    }
});