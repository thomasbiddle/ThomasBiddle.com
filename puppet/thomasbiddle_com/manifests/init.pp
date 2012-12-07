# Setup ThomasBiddle.com
class thomasbiddle_com {

  # Setup the Apache Virtual Host
  file { '/etc/apache2/sites-available/thomasbiddle.com':
    ensure  => present,
    content => template('thomasbiddle_com/apache2.erb'),
  }

  file { '/etc/apache2/sites-enabled/thomasbiddle.com':
    ensure => link,
    target => '/etc/apache2/sites-available/thomasbiddle.com',
    require => File['/etc/apache2/sites-available/thomasbiddle.com'],
  }

  # Ensure the file structure is in place.
  file { '/srv/':
    ensure => directory,
  }
  file { '/srv/www/':
    ensure  => directory,
    require => File['/srv/'],
  }
  file { '/srv/www/thomasbiddle.com':
    ensure  => link,
    target  => '/home/tj/Sites/ThomasBiddle.com/', # Hard coding this for now.
    require => File['/srv/www/'],
  }

}
