// component that renders a single user
window.UserRow = React.createClass({
    render: function () {
        return (
                <tr>
                    <td>{this.props.user.first_name}</td>
                    <td>{this.props.user.last_name}</td>
                    <td>{this.props.user.email}</td>
                    <td>{this.props.user.user_type}</td>
                    <td>
                        <a href='#'
                           onClick={() => this.props.changeAppMode('view', this.props.user.id)}
                           className='btn btn-info m-r-1em'> View
                        </a>
                        <a href='#'
                           onClick={() => this.props.changeAppMode('update', this.props.user.id)}
                           className='btn btn-primary m-r-1em'> Edit
                        </a>
                        <a
                            onClick={() => this.props.changeAppMode('delete', this.props.user.id)}
                            className='btn btn-danger'> Delete
                        </a>
                    </td>
                </tr>
                );
    }
});