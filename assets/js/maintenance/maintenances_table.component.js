// component for the whole maintenances table
window.MaintenancesTable = React.createClass({
    render: function () {

        var rows = this.props.maintenances
                .map(function (maintenance, i) {
                    return (
                            <MaintenanceRow
                                key={i}
                                maintenance={maintenance}
                                changeAppMode={this.props.changeAppMode} />
                            );
                }.bind(this));
               

        return(
                !rows.length
                ? <div className='alert alert-danger'>No records found.</div>
                :
                <table className='table table-bordered table-hover'>
                    <thead>
                        <tr>
                            <th>Maintenance nname</th>
                            <th>cost</th>
                            <th>Description</th>
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