// component that contains the logic to read one user
window.ViewUserComponent = React.createClass({
    getInitialState: function () {
        // Get this user fields from the data attributes we set on the
        // #content div, using jQuery
        return {
            id: '',
            first_name: '',
            last_name: '',
            email: '',
            user_type: '',
            active: ''
        };
    },

// on mount, read user data and them as this component's state
    componentDidMount: function () {

        var id = this.props.id;

        this.serverRequestProd = $.get("http://localhost/amt/API/user/view.php?id=" + id,
                function (user) {
                    user = user.data;
                    this.setState({id: user.id});
                    this.setState({first_name: user.first_name});
                    this.setState({last_name: user.last_name});
                    this.setState({email: user.email});
                    this.setState({password: ''});
                    this.setState({user_type: user.user_type});
                }.bind(this));


        $('.page-header h1').text('View User');
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
                        Users
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
                                    <td>User type</td>
                                    <td>{this.state.user_type}</td>
                                </tr>
                
                            </tbody>
                        </table>
                    </form>
                </div>
                );
    }
});