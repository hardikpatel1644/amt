// component for the whole users table
window.UsersTable = React.createClass({
    render: function () {

        var rows = this.props.users
                .map(function (user, i) {
                    return (
                            <UserRow
                                key={i}
                                user={user}
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
                            <th>Firstname</th>
                            <th>Lastname</th>
                            <th>Email</th>
                            <th>User Type</th>
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