/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


// component that decides which main component to load: read or create/update
var MainAppMaintenance = React.createClass({

// initial mode is 'read' mode
getInitialState: function() {
    return {
        currentMode: 'read',
        id: null
    };
},
        // used when use clicks something that changes the current mode
        changeAppMode: function(newMode, id) {
            this.setState({currentMode: newMode});
            if (id !== undefined) {
                this.setState({id: id});
            }
        },
        // render the component based on current or selected mode
        render: function() {

            var modeComponent =
                    <MaintenancesComponent changeAppMode = {this.changeAppMode}/> ;
                    switch (this.state.currentMode){
                          case 'read':
                    break;
                    case 'view':
                    modeComponent = < ViewMaintenanceComponent id = {this.state.id} changeAppMode = {this.changeAppMode} / > ;
                    break;
                    case 'create':
                    modeComponent = < CreateMaintenanceComponent changeAppMode = {this.changeAppMode} / > ;
                    break;
                    case 'update':
                    modeComponent = < UpdateMaintenanceComponent id = {this.state.id} changeAppMode = {this.changeAppMode} / > ;
                    break;
                    case 'delete':
                    modeComponent = < DeleteMaintenanceComponent id = {this.state.id} changeAppMode = {this.changeAppMode} / > ;
                    break;
                    default:
                    break;
           
        }

        return modeComponent;
        }
});
// go and render the whole React component on to the div with id 'content'
        ReactDOM.render(
                < MainAppMaintenance / > ,
                document.getElementById('content')
        );