# The test
## A few things to note that I (ignored isn't the right word).  But thought Hmmmm.  Is this a trick or just poorly worded?
 1. If the length of the shipment's destination street name is odd, the base SS is the
number of consonants in the driver’s name multiplied by 1. (multiply by 1???)

2. If the length of the shipment's destination street name shares any common factors
(besides 1) with the length of the driver’s name, the SS is increased by 50% above the
base SS. (if we are only comparing length here what else would be common?).  My only other thought is you are looking for GCD? Greatest Common Divisor?

```
function calculateGCD($a, $b) {
    if ($b == 0) {
        return $a;
    }
    return calculateGCD($b, $a % $b);
}

$streetNameLength = strlen($streetName);
$driverNameLength = strlen($driverName);
$gcd = calculateGCD($streetNameLength, $driverNameLength);
if ($gcd > 1) {
    $ss += 0.5 * $baseSS;
}

//PHP's gmp_gcd() might work just as well
```

If I got that wrong then I'll let you explain it to me. :)

## Explanation of what I made here
For starters I did not use Laravel.  I could have and the artisan commands would have worked nicely.  But I wanted a project that didn't have any dependencies should you want to run it.   It DOES use composer, but only ps4 which defines local mappings.  Using all of Laravel just felt like overkill in this scenario.

Speaking of overkill I have too much of it in some places and not enough in others.  It will give us something to talk about.

## How to run
1. Download this code from github
2. Probably do a `composer install`
3. from the command line : 	`php sde.php addresses.txt drivers.txt`
4. The entry point of the application is `sde.php`

## Feedback?
alloyking@gmail.com
651-329-5653
or make a pull request :)
