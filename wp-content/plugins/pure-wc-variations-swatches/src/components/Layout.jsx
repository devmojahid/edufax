import React from 'react'
import NavLink from './NavLink'
import { Outlet } from 'react-router-dom'

export default function Layout() {
  return (
    <div>
        <nav>
            <ul>
                <li>
                    <NavLink to="">
                        Welcome
                    </NavLink>
                </li>
                <li>
                    <NavLink to="settings">
                        Settings
                    </NavLink>
                </li>
                <li>
                    <NavLink to="learn">
                        Learn
                    </NavLink>
                </li>
                <li>
                    <NavLink to="about">
                        About
                    </NavLink>
                </li>
            </ul>
        </nav>
        <hr />
        <Outlet/>
    </div>
  )
}
