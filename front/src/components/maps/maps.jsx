import React from 'react';
import { Map, GoogleApiWrapper, Marker, InfoWindow } from 'google-maps-react';


const containerStyle = {
    position: 'absolute',
    width: '80%',
    height: '70%',
    left: '0',
    marginLeft: 'auto',
    marginRight: 'auto',
    right: '0',
    textAlign: 'center'
}

export class MapContainer extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            showingInfoWindow: false,
            activeMarker: {},
            selectedPlace: {},
        }
    }

    displayMarkers = () => {
        return this.props.points.map((store, index) => {
            return <Marker
                key={index}
                id={index}
                position={{ lat: store.lat, lng: store.lng }}
                onClick={this.onMarkerClick}
                name={store.nome_fantasia}
                title={store.nome_fantasia}
            >
                <InfoWindow
                    marker={this.state.activeMarker}
                    visible={this.state.showingInfoWindow}>
                    <div>
                        <h1>{this.state.selectedPlace.name}</h1>
                    </div>
                </InfoWindow>
            </Marker>
        })
    }

    onMarkerClick = (props, marker, e) =>
        this.setState({
            selectedPlace: props,
            activeMarker: marker,
            showingInfoWindow: true
        });

    onMapClicked = (props) => {
        if (this.state.showingInfoWindow) {
            this.setState({
                showingInfoWindow: false,
                activeMarker: null
            })
        }
    };

    render() {
        console.log("to rendereizando?")
        return (
            <Map
                google={this.props.google}
                zoom={8}
                style={containerStyle}
                onClick={this.onMapClicked}
                center={this.props.points[0] ? this.props.points[0] : { lat: -23.5489, lng: -46.6388 }}
                containerStyle={containerStyle}
                initialCenter={this.props.points[0] ? this.props.points[0] : { lat: -23.5489, lng: -46.6388 }}
            >
                {this.displayMarkers()}
            </Map>
        );
    }
}

export default GoogleApiWrapper({
    apiKey: 'AIzaSyBQi_SA00EeV-uNg6Hnu77ItPWTzGJIzmg'
})(MapContainer);