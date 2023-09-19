import React from 'react'
import {
  Link,
  useResolvedPath,
  useMatch
} from "react-router-dom"

export default function NavLink({ children, to, ...props}) {
  let resolved = useResolvedPath(to)
  let match = useMatch({ path: resolved.pathname, end: true})

  return (
    <div>
      <Link to={to} {...props} style={{ textDecoration: match ? "underline" : "none" }}>
        { children }
      </Link>
      { match && "(active)" }
    </div>
  )
}
