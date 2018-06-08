// component that contains all the logic and other smaller components
// that form the Read Users view
window.UsersComponent = React.createClass({
    getInitialState: function () {
        return {
            users: [],
        };
    },

    // on mount, fetch all users and stored them as this component's state
    componentDidMount: function () {

        this.serverRequest = $.get("http://localhost/amt/API/user", function (users) {
            if (users['error'] == true)
            {
                this.setState({messageCreation: "error"});
            }

            this.setState({
                users: users.data
            });
        }.bind(this));
    },

    // on unmount, kill product fetching in case the request is still pending
    componentWillUnmount: function () {
        this.serverRequest.abort();
    },

    // render component on the page
    render: function () {
        // list of users
        var filteredUsers = this.state.users;
        $('.page-header h1').text('Users');

        return (
                <div>
                    <div className='overflow-hidden'>
                        <TopActionsComponent changeAppMode={this.props.changeAppMode} />
                        <UsersTable
                            users={filteredUsers}
                            changeAppMode={this.props.changeAppMode} />
                    </div>
                </div>
                            );
                }
    });