import React, { Component } from 'react';
import ReactDOM from 'react-dom';

export default class App extends Component {

    render() {
        return (
            <h1>Welcome To React App</h1>
        );
    }
}

if (document.getElementById('root')) {
    ReactDOM.render(<App />, document.getElementById('root'));
}
