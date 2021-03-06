import React, { useMemo } from 'react'
import PropTypes from 'prop-types'
import { Search }  from '@material-ui/icons'

import useStyles, { MyInputBase } from './use-styles'

const SearchField = ({ onChange, value, name }) => {
	const styles = useStyles()
	const inputProps = useMemo(() => ({ 'aria-label': 'search' }), [])

	return (
		<div className={styles.search}>
			<div className={styles.searchIcon}>
				<Search />
			</div>
			<MyInputBase
				placeholder="Pesquise por palavra-chave"
				inputProps={inputProps}
				onChange={onChange}
				name={name}
				value={value}
			/>
		</div>
		)
}

SearchField.propTypes = {
	onChange: PropTypes.func,
	value: PropTypes.string,
	name: PropTypes.string
}

SearchField.defaultProps = {
	onChange: () => {},
	value: '',
	name: 'search'
}

export default React.memo(SearchField)
