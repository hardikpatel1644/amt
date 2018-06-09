// component that renders a single vehicle
window.VehicleRow = React.createClass({

    render: function () {
        return (
                <tr>
                    <td>{this.props.vehicle.company}</td>
                    <td>{this.props.vehicle.model}</td>
                    <td>{this.props.vehicle.model_year}</td>
                    <td>{this.props.vehicle.vehicle_type}</td>
                    <td>{this.props.vehicle.active == "1" ? "Yes" : "No"}</td>
                    <td>
                        <a href='#'
                           onClick={() => this.props.changeAppMode('view', this.props.vehicle.id)}
                           className='btn btn-info m-r-1em'> View
                        </a>
                
                       <a href='#'
                            onClick={() => this.props.changeAppMode('view_all_maintenance', this.props.vehicle.id)}
                           className='btn btn-info m-r-1em'> View Maintenance
                        </a>
                        <a href='#'
                           onClick={() => this.props.changeAppMode('update', this.props.vehicle.id)}
                           className='btn btn-primary m-r-1em'> Edit
                        </a>
                        <a
                            onClick={() => this.props.changeAppMode('delete', this.props.vehicle.id)}
                            className='btn btn-danger'> Delete
                        </a>
                    </td>
                </tr>
                );
    }
});