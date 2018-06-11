/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


// component that contains the logic to delete a product
window.DeleteMaintenanceComponent = React.createClass({

    // initialize values
    getInitialState: function () {
        return {
            messageCreation: null,
            message: null
        };
    },
    // componentDidMount will be here
    // on mount, change header text
    componentDidMount: function () {
             //var id_vehicle = this.props.id_vehicle;
        $('.page-header h1').text('Delete Maintenance');
    },

// onDelete will be here
// handle single row deletion
    onDelete: function (e) {

        // product to delete
        var id = this.props.id;


        // submit form data to api
        $.ajax({
            url: "http://localhost/amt/API/maintenance/delete.php?id=" + id,
            type: "GET",
            // contentType: 'application/json',
            //data: 'id': id,
            success: function (response) {
                if (response['error'] == true)
                {
                    this.setState({messageCreation: "error"});
                }
                if (response['success'] == true)
                {
                    this.setState({messageCreation: "success"});
                }
                this.props.changeAppMode('view',this.state.id_vehicle);
                //this.props.changeAppMode('read');
            }.bind(this),
            error: function (xhr, resp, text) {
                // show error in console
                console.log(xhr, resp, text);
            }
        });
    },

// render will be here
    render: function () {

        return (
                <div className='row'>
                    <div className='col-md-3'></div>
                    <div className='col-md-6'>
                        <div className='panel panel-default'>
                            <div className='panel-body text-align-center'>Are you sure?</div>
                            <div className='panel-footer clearfix'>
                                <div className='text-align-center'>
                                    <button onClick={this.onDelete}
                                            className='btn btn-danger m-r-1em'>Yes</button>
                                    <button  onClick={() => this.props.changeAppMode('view',this.state.id_vehicle)}
                                            className='btn btn-primary'>No</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div className='col-md-3'></div>
                </div>
                );
    }
});