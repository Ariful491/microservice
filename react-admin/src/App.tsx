import React from 'react';
import './App.css';
import LineChart from "./LineChart";
import Header from "./components/Header";
import SideBar from "./components/SideBar";
import Dashboard from "./components/Dashboard";

function App() {


    return (
        <>
            <Header/>
            <div className="container-fluid">
                <div className="row">
                    <SideBar/>

                     <main className="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                      <Dashboard/>
                    </main>
                </div>
            </div>
        </>
    );
}

export default App;
