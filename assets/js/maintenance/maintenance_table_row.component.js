// component that renders a single maintenance
window.MaintenanceRow = React.createClass({
    render: function () {
        return (
                <tr>
                    <td>{this.props.maintenance.first_name}</td>
                    <td>{this.props.maintenance.last_name}</td>
                    <td>{this.props.maintenance.email}</td>
                    <td>{this.props.maintenance.active == "1" ? "Yes" : "No"}</td>
                    <td>{this.props.maintenance.maintenance_type}</td>
                    <td>
                        <a href='#'
                           onClick={() => this.props.changeAppMode('view', this.props.maintenance.id)}
                           className='btn btn-info m-r-1em'> View
                        </a>
                        <a href='#'
                           onClick={() => this.props.changeAppMode('update', this.props.maintenance.id)}
                           className='btn btn-primary m-r-1em'> Edit
                        </a>
                        <a
                            onClick={() => this.props.changeAppMode('delete', this.props.maintenance.id)}
                            className='btn btn-danger'> Delete
                        </a>
                    </td>
                </tr>
                );
    }
});