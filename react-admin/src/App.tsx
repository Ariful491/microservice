import React from 'react';
import Dashboard from "./secure/Dashboard";
import {BrowserRouter, Routes, Route} from "react-router-dom";
import User from "./secure/User";
import Login from "./public/Login";
import Register from "./public/Register";

function App() {

    return (
        <>
            <div>
                <BrowserRouter>
                    <Routes>
                        <Route path={'/'} Component={Dashboard}/>
                        <Route path={'/user'} Component={User}/>
                        <Route path={'/login'} Component={Login}/>
                        <Route path={'/register'} Component={Register}/>
                    </Routes>
                </BrowserRouter>
            </div>

        </>
    );
}

export default App;
