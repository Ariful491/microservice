import React from 'react';
import './App.css';
import Header from "./secure/components/Header";
import SideBar from "./secure/components/SideBar";
import Dashboard from "./secure/Dashboard";
import {BrowserRouter, Routes, Route} from "react-router-dom";
import User from "./secure/User";

function App() {


    return (
        <>
            <Header/>
            <div className="container-fluid">
                <div className="row">
                    <SideBar/>

                    <main className="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                        <BrowserRouter>
                            <Routes>
                                <Route path={'/'} Component={Dashboard}/>
                                <Route path={'/user'} Component={User}/>
                            </Routes>
                        </BrowserRouter>
                    </main>
                </div>
            </div>
        </>
    );
}

export default App;
