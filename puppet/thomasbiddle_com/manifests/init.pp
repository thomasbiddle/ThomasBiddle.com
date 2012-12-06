
# Setup ThomasBiddle.com
class thomasbiddle_com {

  # Ensure apache2 is installed and up to date.
  package { 'apache2':
    ensure => 'latest',
  }

  # Setup the Apache Virtual Host
  # (After testing, will set this up using the PuppetLabs apache module)
  file { '/etc/apache2/sites-available/thomasbiddle.com':
    ensure  => present,
    require => Package['apache2'],
    content => template('thomasbiddle_com/apache2.erb'),
  }

  file { '/etc/apache2/sites-enabled/thomasbiddle.com':
    ensure => link,
    target => '/etc/apache2/sites-available/thomasbiddle.com',
    rquire => File['/etc/apache2/sites-available/thomasbiddle.com'],
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
